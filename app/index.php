<?php

require __DIR__.'/vendor/autoload.php';

use App\Commands\EmailQuoteCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv();
$env->load(__DIR__.'/.env');

$application  = new Application();

$application->add(new EmailQuoteCommand());

$application->run();

