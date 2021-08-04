<?php

namespace App\Command;

use App\Juni\Juni;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'juni',
    description: 'Add a short description for your command',
)]
class JuniCommand extends Command
{
    private $juni;

    public function __construct(Juni $juni)
    {
        $this->juni = $juni;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('tempalate', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('render', InputArgument::OPTIONAL, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $tempalate = $input->getArgument('tempalate');
        $render = $input->getArgument('render');

        //$tempalate = '{{test}}'; $render = 'Dina';

        if (!$tempalate) {
            $io->note(sprintf('You not passed an argument: %s', $tempalate));
        }

        if (!$render) {
            $io->note(sprintf('You not passed an argument: %s', $render));
        }

        if ($tempalate && $render) {
            $out = $this->juni->exec($tempalate, $render);
            $output->writeln(json_encode($out));
        }

        return Command::SUCCESS;
    }
}
