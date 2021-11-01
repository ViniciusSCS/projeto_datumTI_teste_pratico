<?php

namespace App\Command;

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
            ->addOption('request', null, InputOption::VALUE_OPTIONAL, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $string_entrada = $input->getArgument('string_entrada');
        $qtd_request = $input->getOption('request');

        for($i = 1; $i <= $qtd_request; $i++){
//            $io->success($haseGenerate);
//            return Command::SUCCESS;
            $hg = new HashGenerates();
            $hashGenerate = $hg->setStringEntrada($string_entrada);
            $io->writeln($hashGenerate);
            return Command::SUCCESS;
//            $aux = new HashGenerateController();

//            $aux->encontra_zeros($hg, 1);
//            $hashGenerate = $hg->getChaveEncontrada();

        }
        return Command::SUCCESS;
//            $io->success($haseGenerate);
//            return Command::SUCCESS;


    }
}
