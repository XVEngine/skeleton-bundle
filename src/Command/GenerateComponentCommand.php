<?php

namespace XVEngine\Bundle\SkeletonBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Filesystem\Filesystem;
use XVEngine\Bundle\SkeletonBundle\Console\AbstractCommand;
use XVEngine\Bundle\SkeletonBundle\Generators\Bundle;
use XVEngine\Bundle\SkeletonBundle\Generators\Component;

/**
 * Class GenerateCommand
 * @author Krzysztof Bednarczyk
 * @package XVEngine\Bundle\SkeletonBundle\Command
 */
class GenerateComponentCommand extends AbstractCommand
{
    /**
     * @author Krzysztof Bednarczyk
     */
    protected function configure()
    {
        $this
            ->setName('new:component')
            ->setDescription('Generating new component');
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $file = "composer.json";

        if (!file_exists($file)) {
            $output->writeln("Unable to find composer.json . Are you inside xv bundle directory?");
            return;
        }

        $composer = json_decode(
            file_get_contents($file),
            true
        );

        if (!$composer || !isset($composer['extra']) || !isset($composer['extra']['xv-namespace'])) {
            $output->writeln("Unable to find extra.xv-namespace variable in composer.json . Are you inside xv bundle directory?");
            return;
        }


        $component = new Component();


        $helper = $this->getHelper('question');
        $question = new Question("Please enter namespace of component, ex: utils.testComponent : \n");

        $component->setNamespace(
            $helper->ask($input, $output, $question)
        );


        $helper = $this->getHelper('question');
        $question = new Question("Please enter HTML tag name, ex: xv-example : \n");

        $component->setTagName(
            $helper->ask($input, $output, $question)
        );

        $fs = new Filesystem();


        $dirs = explode(".", $component->getNamespace());
        $componentName = array_pop($dirs);

        $appDir = './Resources/app/component';
        $scssDir = './Resources/scss/component';
        $phpDir = "./Component";

        $phpNamespace = "";

        foreach ($dirs as $dir) {
            $appDir .= "/{$dir}";
            $scssDir .= "/{$dir}";
            $phpDirName = ucfirst($dir);
            $phpDir .= "/{$phpDirName}";
            $phpNamespace .= "\\{$phpDirName}";
        }

        $fs->mkdir($appDir);
        $fs->mkdir($scssDir);
        $fs->mkdir($phpDir);

        $appDir = realpath($appDir);
        $scssDir = realpath($scssDir);
        $phpDir = realpath($phpDir);


        file_put_contents("{$scssDir}/{$componentName}.scss", "{$component->getTagName()} { \n}");


        $jsFile = file_get_contents(
            realpath(__DIR__ . "/../Resource/template/component/exampleComponent.js")
        );

        $jsFile = strtr($jsFile, [
            "exampleComponent" => $componentName,
            "xv-tag-name" => $component->getTagName(),
        ]);

        file_put_contents("{$appDir}/{$componentName}.js", $jsFile);


        $phpFile = file_get_contents(
            (__DIR__ . "/../Resource/template/component/ExampleComponent.php")
        );
        $componentNamePHP = ucfirst($componentName);
        $phpFile = strtr($phpFile, [
            "utils.exampleComponent" => $component->getNamespace(),
            "ExampleComponent" => $componentNamePHP,
            "XVEngine\\Bundle\\ExampleBundle\\Component\\Utils" =>
                $composer['extra']['xv-namespace'] .
                "Component" .
                $phpNamespace,
        ]);


        file_put_contents("{$phpDir}/{$componentNamePHP}.php", $phpFile);

        $output->writeln("Done");
    }
}