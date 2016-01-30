<?php
namespace Fdbc\Resto\BackBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;

class ImportFromAgircultureMinistryCommand extends ContainerAwareCommand
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
                var_dump($record->recordid);
                var_dump($record->fields);
            }
        }
    }
}