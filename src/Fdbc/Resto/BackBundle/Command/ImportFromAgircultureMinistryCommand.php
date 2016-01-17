<?php
namespace Fdbc\Resto\BackBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportFromAgircultureMinistryCommand extends Command
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
        $text = 'Hello';
        $output->writeln($text);
    }
}