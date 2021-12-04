<?php

require __DIR__.'/vendor/autoload.php';

use App\Commands\SendQuoteToTelegram;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv();
$env->load(__DIR__.'/.env');

$application  = new Application();

$application->add(new SendQuoteToTelegram());

try {
    $application->run();
} catch (Exception $e) {
    die($e->getMessage());
}

