<?php

class DBConnection
{
    private ?PDO $pdo = null;

    public function getPDO(): PDO
    {
        //Si la connexion n'existe pas encore
        if ($this->pdo === null) {

            try {
                //Connexion MySQL avec PDO
                $this->pdo = new PDO(
                    "mysql:host=localhost;dbname=contacts_cli;charset=utf8mb4",
                    "root",
                    ""
                );

                //Activer les erreurs PDO en exception
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}