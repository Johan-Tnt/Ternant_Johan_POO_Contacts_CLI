<?php

require __DIR__ . '/vendor/autoload.php';

use Johan\ContactCli\Config\EnvLoader;
use Johan\ContactCli\Console\Console;

//Charge les variables du .env
EnvLoader::load(__DIR__ . '/.env');

//Point d'entrée de l'application CLI
$console = new Console();
$console->run();