<?php


namespace Johan\ContactCli\Manager;

use PDO;
use Johan\ContactCli\Database\DBConnection;
use Johan\ContactCli\Entity\Contact;

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

    //Transforme une ligne SQL (array) en objet Contact
    //@param array $row Données issues de la base de données et @return Contact Objet métier Contact
    private function hydrate(array $row): Contact
    {
        $contact = new Contact();

        $contact->setId($row["id"]);
        $contact->setName($row["name"]);
        $contact->setEmail($row["email"]);
        $contact->setPhoneNumber($row["phone_number"]);

        return $contact;
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
        $contacts[] = $this->hydrate($row);
        }

        return $contacts;
    }

    //Récupère un contact unique depuis la base de données à partir de son id
    public function findById(int $id): ?Contact
    {
        //Requête SQL avec paramètre nommé pour éviter les injections SQL
        $sql = "SELECT * FROM contacts WHERE id = :id";
        //Prépare la requête (sécurisé + optimisé pour les requêtes avec paramètres)
        $stmt = $this->pdo->prepare($sql);
        //Exécute la requête en injectant la valeur de l'id dans le paramètre :id
        $stmt->execute([
            "id" => $id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Si aucun résultat n'est trouvé
        if ($row === false) {
            return null;
        }

        //Transformation en objets Contact
         return $this->hydrate($row);
    }

    //Insère un nouveau contact dans la base de données
    public function create(Contact $contact): void
    {
        //Requête SQL paramétrée pour éviter les injections SQL
        $sql = "INSERT INTO contacts (name, email, phone_number)
            VALUES (:name, :email, :phone_number)";

        $stmt = $this->pdo->prepare($sql);

        //On utilise les getters pour respecter l'encapsulation de la classe Contact
        $stmt->execute([
            "name" => $contact->getName(),
            "email" => $contact->getEmail(),
            "phone_number" => $contact->getPhoneNumber(),
        ]);
    }

    //Supprime un contact de la base de données à partir de son id
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "id" => $id
        ]);

        //Si aucune ligne n'a été supprimée alors l'id n'existe pas
        return $stmt->rowCount() >  0;
    }

    //Met à jour un contact déjà existant dans la base de données 
    public function modify(Contact $contact): bool 
    {
         $sql = "UPDATE contacts
                SET name = :name, email = :email, phone_number = :phone_number
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "id" => $contact->getId(),
            "name" =>$contact->getName(),
            "email" => $contact->getEmail(),
            "phone_number" => $contact->getPhoneNumber(),     
        ]);

        //Si une ligne a été modifiée
        return $stmt->rowCount() >  0;
    }
}