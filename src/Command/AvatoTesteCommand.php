<?php

namespace App\Command;

use App\Controller\HashGeneratesController;
use App\Entity\HashGenerates;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AvatoTesteCommand extends Command
{
    protected static $defaultName = 'avato:test ';
    protected static $defaultDescription = 'Comando para testar aplicação';

    protected function configure(): void
    {
        $this
            ->addArgument('string_entrada', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('requests', null, InputOption::VALUE_OPTIONAL, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $hashGenerate = $input->getArgument('string_entrada');
        $qtd_request = $input->getOption('requests');


        for ($i = 1; $i <= $qtd_request; $i++)
        {
            $hg = new HashGenerates();
            $string_entrada = $hg->setStringEntrada($hashGenerate);
            $controller = new HashGeneratesController();

            $controller->encontra_zeros($hg, $string_entrada, 1);
            dd($hg);
            return $io->writeln($hg->getChaveEncontrada());
            $hashGenerate = $hg->getChaveEncontrada();
        }
        return Command::SUCCESS;


    }
}
