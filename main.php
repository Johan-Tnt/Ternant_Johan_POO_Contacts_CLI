<?php

require_once "src/Database/DBConnection.php";

$db = new DBConnection();

//Test connexion (le supprimer après)
var_dump($db->getPDO());

while (true) {
    $line = readline("Enter your command: ");

    //LIST
    if ($line === "list") {
        echo "Affichage de la liste des contacts\n";
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