<?php
namespace XVEngine\Bundle\SkeletonBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use VEngine\Bundle\SkeletonBundle\Console\AbstractCommand;

/**
 * Class Application
 * @author Krzysztof Bednarczyk
 * @package XVEngine\Bundle\SkeletonBundle\Command
 */
class Application extends \Symfony\Component\Console\Application
{

    /**
     * @author Krzysztof Bednarczyk
     * @return array
     */
    public function findCommandClasses()
    {

        $finder = new Finder();

        $files = $finder->in([
            __DIR__ . '/Command'
        ])->name("*Command.php");

        /** @var \SplFileInfo $file */
        foreach ($files as $file) {
            require_once($file->getRealpath());
        }

        $classes = array_filter(get_declared_classes(), function ($name) {
            return preg_match('/Command\\\(.+)Command/', $name) > 0 &&
            is_subclass_of($name, AbstractCommand::class);
        });


        return $classes;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @return $this
     */
    public function loadCommands()
    {

        foreach ($this->findCommandClasses() as $class) {
            $this->add(new $class($this));
        }
        return $this;
    }

    /**
     * @author Krzysztof Bednarczyk
     * @param InputInterface|null $input
     * @param OutputInterface|null $output
     * @return int
     * @throws \Exception
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->loadCommands();
        return parent::run($input, $output);
    }


}