<?php
namespace Fdbc\Resto\BackBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;

use Fdbc\Resto\CoreBundle\Document\Restaurant;

class ImportFromAgricultureMinistryCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('fdbc:resto:import_from_agriculture_ministry')
            ->setDescription('Import data source form Open data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        $res = $client->request('GET', $this->getContainer()->getParameter('data_source_url'), []);
        if ($res->getStatusCode() == 200) {
            $result = json_decode($res->getBody());
            foreach ($result->records as $record) {
                $restaurant = $this->getContainer()->get('doctrine_mongodb')
                    ->getRepository('FdbcRestoCoreBundle:Restaurant')
                    ->findOneBy(array('name' => $record->fields->nom, 'adress' => $record->fields->adresse));

                if ($restaurant === null) {
                    $restaurant = new Restaurant();
                    $restaurant->setName($record->fields->nom);
                    $restaurant->setAdress($record->fields->adresse);
                    $restaurant->setZipCode($record->fields->code_postal);
                    $restaurant->setLongName($record->fields->libelle_etablissement);
                    $restaurant->setLat($record->fields->coordonnees_geo[0]);
                    $restaurant->setLon($record->fields->coordonnees_geo[1]);
                }

                $restaurant->setInspectionDate($record->fields->date_inspection);
                $restaurant->setScore($record->fields->evaluation);

                $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
                $dm->persist($restaurant);
            }
            $dm->flush();
        }
    }
}
