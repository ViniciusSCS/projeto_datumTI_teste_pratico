<?php

namespace App\Command;

use App\Controller\HashCommandController;
use App\Controller\HashGeneratesController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AvatoTesteCommand extends Command
{
    protected static $defaultName = 'avato:test';
    protected static $defaultDescription = 'Comando para testar aplicação';

    private $hashcommand;
    private $hashControler;

    public function __construct(HashCommandController $hashcommand, HashGeneratesController $hashControler)
    {
        parent::__construct();
        $this->hashcommand = $hashcommand;
        $this->hashControler = $hashControler;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('string_entrada', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('requests', null, InputOption::VALUE_OPTIONAL, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $stringEntrada = $input->getArgument('string_entrada');
        $qtd_request = $input->getOption('requests');

        $this->getHashCommand($stringEntrada, $qtd_request);

        $output->writeln(['SUCCESS']);
        return Command::SUCCESS;

    }

    private function getHashCommand(string $stringEntrada, $qtd_request)
    {
        $this->hashControler->initHash($stringEntrada, $qtd_request);
    }


}
