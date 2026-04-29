<?php

require_once "src/Command/Command.php";

//class Command qui contient toutes les commandes LIST, etc...
$command = new Command();

//Boucle infinie CLI
while (true) {
    $line = readline("Enter your command (list, quit): ");

    //LIST contacts
    if ($line === "list") {
    //Lecture de commande pour LIST
        $command->list();
        continue;
    }

    //QUIT
    if ($line === "quit") {
        echo "Bye!\n";
        break;
    }

    //DEFAULT
    echo "Unknown command\n";
}