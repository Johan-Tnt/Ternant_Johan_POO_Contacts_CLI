<?php

require_once "src/Database/DBConnection.php";
require_once "src/Manager/ContactManager.php";

$db = new DBConnection();
$manager = new ContactManager();

//Boucle infinie CLI
while (true) {
    $line = readline("Enter your command: ");

    //LIST contacts
    if ($line === "list") {

        $contacts = $manager->findAll();

       //Affichage via __toString()
        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }

        continue;
    }

    //QUIT
    if ($line === "quit") {
        echo "Bye!\n";
        break;
    }

    //DEFAULT
    echo "Commande inconnue\n";
}