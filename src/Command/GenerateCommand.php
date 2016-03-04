<?php

namespace XVEngine\Bundle\SkeletonBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use XVEngine\Bundle\SkeletonBundle\Console\AbstractCommand;
use XVEngine\Bundle\SkeletonBundle\Generators\Bundle;

class GenerateCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('xv:bundle')
            ->setDescription('Generating new bundle')
            ->addArgument(
                'dir',
                InputArgument::OPTIONAL,
                'Directory to generate',
                null
            );
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $bundle = new Bundle();


        $helper = $this->getHelper('question');
        $question = new Question("Please enter the name of the package name, ex: acme/test-bundle: \n");

        $bundle->setPackageName(
            $helper->ask($input, $output, $question)
        );

        $question = new Question("Please package description: \n");

        $bundle->setPackageDescription(
            $helper->ask($input, $output, $question)
        );


        $question = new Question("Please your name ex: Joe Doe: \n");

        $bundle->setAuthorName(
            $helper->ask($input, $output, $question)
        );


        $question = new Question("Please your email ex: lore@example.com: \n");
        $bundle->setAuthorEmail(
            $helper->ask($input, $output, $question)
        );


        $question = new Question("Enter your website url:  \n");
        $bundle->setAuthorUrl(
            $helper->ask($input, $output, $question)
        );


        $fs = new Filesystem();

        $dirName = explode("/", $bundle->getPackageName())[1];
        mkdir($dirName);
        $dirPath = realpath($dirName);

        copy(
            __DIR__ . '/../Resource/template/bundle',
            $dirPath
        );


    }
}