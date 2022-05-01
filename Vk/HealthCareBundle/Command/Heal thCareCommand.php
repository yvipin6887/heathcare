<?php
namespace App\Vk\HealthCareBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class HealthCareCommand extends Command{

    protected static $defaultName = 'demo:healthcare-user';
    public function __construct($projectDir)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->projectDir = $projectDir;

        parent::__construct();
    }

     protected function configure()
     {
        $this
        // ->setName('demo:healthcare')
        ->setDescription('this is HealthCare.')
        ->addArgument(
            'name',
            InputArgument::OPTIONAL,
            'have you any Health Issue?'
        )
        ->addOption(
            'yell',
            null,
            InputOption::VALUE_NONE,
            'If set, the task will yell in uppercase letters'
        )
    ;
     }

     protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }

        $output->writeln($text);
    }

}