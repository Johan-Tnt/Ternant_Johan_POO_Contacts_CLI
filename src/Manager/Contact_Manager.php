<?php

class ContactManager
{
    private PDO $pdo;

    public function __construct()
    {
        //On récupère la connexion PDO
        $db = new DBConnection();
        $this->pdo = $db->getPDO();
    }

    //Récupérer tous les contacts
    public function findAll(): array
    {
        $sql = "SELECT * FROM contacts";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}