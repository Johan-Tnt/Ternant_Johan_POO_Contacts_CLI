<?php

require __DIR__ . '/vendor/autoload.php';

use Johan\ContactCli\Console\Console;

//Point d'entrée de l'application CLI
$console = new Console();
$console->run();