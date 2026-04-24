<?php

require_once "src/Database/DBConnection.php";
require_once "src/Manager/Contact_Manager.php";

$db = new DBConnection();
$manager = new ContactManager();

while (true) {
    $line = readline("Enter your command: ");

    //LIST
    if ($line === "list") {

        $contacts = $manager->findAll();

        foreach ($contacts as $contact) {
            echo $contact['id'] . " - " .
                 $contact['name'] . " - " .
                 $contact['email'] . " - " .
                 $contact['phone_number'] . "\n";
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