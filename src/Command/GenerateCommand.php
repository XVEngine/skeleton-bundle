<?php

namespace XVEngine\Bundle\SkeletonBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Filesystem\Filesystem;
use XVEngine\Bundle\SkeletonBundle\Console\AbstractCommand;
use XVEngine\Bundle\SkeletonBundle\Generators\Bundle;

/**
 * Class GenerateCommand
 * @author Krzysztof Bednarczyk
 * @package XVEngine\Bundle\SkeletonBundle\Command
 */
class GenerateCommand extends AbstractCommand
{
    /**
     * @author Krzysztof Bednarczyk
     */
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



        $question = new Question("Please namespce, ex: Acme\\Bundle\\AcmeBundle: \n");
        $bundle->setNamespace(
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


        /**
         * Coping files
         */
        $directoryIterator = new \RecursiveDirectoryIterator(__DIR__ . '/../Resource/template/bundle', \RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directoryIterator, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $fs->mkdir($dirPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                $fs->copy($item, $dirPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }


        /**
         * Create composer.json
         */
        file_put_contents(
            $dirPath . DIRECTORY_SEPARATOR . 'composer.json',
            json_encode($bundle->toComposerFormat(), JSON_PRETTY_PRINT)
        );


        $output->writeln("Done");
    }
}