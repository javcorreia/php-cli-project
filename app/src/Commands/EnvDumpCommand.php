<?php

namespace App\Cli\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnvDumpCommand extends Command
{
    protected static $defaultName = 'app:env-dump';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        dump(
            $_ENV,
        );

        return Command::SUCCESS;
    }
}