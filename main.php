<?php

require_once "src/Command/Command.php";

//class Command qui contient toutes les commandes LIST, etc...
$command = new Command();

//Boucle infinie CLI
while (true) {
    $line = readline("Enter your command (list, detail, create, delete, help, quit): ");

    //LIST contacts
    if ($line === "list") {
        
        $command->list();
        continue;
    }

    //DETAIL contacts (ex detail 2)
    if (preg_match('/^detail\s+(\d+)$/', $line, $matches)) {
        $id = (int)$matches [1];

        $command->detail($id) ;
        continue;   
    }

    //CREATE contact
    if (preg_match('/^create\s+(.+),\s*(.+),\s*(.+)$/', $line, $matches)) {

        $name = $matches[1];
        $email = $matches[2];
        $phone = $matches[3];

        $command->create($name, $email, $phone);
        continue;
    }

    //DELETE contact
    if(preg_match('/^delete\s+(\d+)$/', $line, $matches)) {

        $id = (int)$matches[1];
        $command->delete($id);
        continue;
    }

   //HELP
    if ($line === "help") {
        $command->help();
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