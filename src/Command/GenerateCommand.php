<?php

namespace VEngine\Bundle\SkeletonBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use VEngine\Bundle\SkeletonBundle\Console\AbstractCommand;

class GenerateCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('xv:bundle')
            ->setDescription('Generating new boundle');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("hello world!");
    }
}