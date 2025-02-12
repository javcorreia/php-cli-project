#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../../vendor/autoload.php';

if (!file_exists('.env')) {
    echo 'Error: .env file not found. Please create one.' . PHP_EOL;
    die();
}

use Dotenv\Dotenv;
use Symfony\Component\Console\Application;

// load dotenv vars
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$application = new Application();

// ... auto register root commands
$commandsDirectory = __DIR__.'/../Commands';
$commands = scandir($commandsDirectory);
foreach ($commands as $command) {
    if ($command !== '.' && $command !== '..' && !is_dir($commandsDirectory . '/' . $command)) {
        $command = str_replace('.php', '', $command);
        $application->add(new ('\\App\\Cli\\Commands\\' . $command)());
    }
}

$application->run();
