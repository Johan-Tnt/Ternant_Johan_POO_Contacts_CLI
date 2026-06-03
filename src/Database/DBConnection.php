<?php

namespace Johan\ContactCli\Database;

use PDO;
use PDOException;

//class DBConnection gère la connexion à la base de données via PDO
class DBConnection
{
    //Instance PDO stockée en mémoire pour éviter plusieurs connexions inutiles
    private ?PDO $pdo = null;

    public function getPDO(): PDO
    {
        //Si la connexion n'existe pas encore
        if ($this->pdo === null) {

            try {

                $host = $_ENV["DB_HOST"];
                $dbname = $_ENV["DB_NAME"];
                $user = $_ENV["DB_USER"];
                $password = $_ENV["DB_PASSWORD"];

                //Connexion MySQL avec PDO
                $this->pdo = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $password
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