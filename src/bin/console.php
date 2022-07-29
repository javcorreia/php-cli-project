#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../../vendor/autoload.php';

use App\Cli\Commands\TestCommand;
use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands
$application->add(new TestCommand());

$application->run();
