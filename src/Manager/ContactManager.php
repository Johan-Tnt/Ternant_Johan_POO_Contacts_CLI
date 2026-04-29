<?php

require_once "src/Database/DBConnection.php";
require_once "src/Entity/Contact.php"; 

//class ContactManager gère l'accès aux données de la table Contact
//Centralise les requêtes SQL liées aux contacts et retourne des objets Contact
class ContactManager
{
    private PDO $pdo;

    public function __construct()
    {
        //On récupère la connexion PDO
        $db = new DBConnection();
        $this->pdo = $db->getPDO();
    }

    //Récupère tous les contacts de la bdd et les transforme en objets Contact
    public function findAll(): array
     {
        $sql = "SELECT * FROM contacts";
        $stmt = $this->pdo->query($sql);
        //Résultat brut SQL
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contacts = [];

        //Transformation en objets Contact
        foreach ($results as $row) {
            $contact = new Contact();

            $contact->setId($row['id']);
            $contact->setName($row['name']);
            $contact->setEmail($row['email']);
            $contact->setPhoneNumber($row['phone_number']);

            $contacts[] = $contact;
        }

        return $contacts;
     }
}