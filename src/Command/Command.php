<?php

require_once "src/Manager/ContactManager.php";

//class Command centralise l'exécution des commandes disponibles dans l'application CLI 
//(list, detail, create, delete, etc.)
class Command
{
    private ContactManager $contactManager;

    public function __construct()
    {
        //Instancie le manager qui communique avec la base de données
        $this->contactManager = new ContactManager();
    }

    //LIST contacts
    public function list(): void
    {
        //Récupère tous les contacts depuis la base
          $contacts = $this->contactManager->findAll();
    
        //Si il n'y a aucun contact
        if (empty($contacts)) {
            echo "No contacts found.\n";
            return;
        }

        echo "Contact list:\n";

         //Affichage des contacts (grâce à __toString() dans Contact)
        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }
    }

    //DETAIL contacts
    public function detail(int $id): void
    {
        //Récupère le contact via son id
        $contact = $this->contactManager->findById($id);

        //Si aucun contact n'est trouvé 
        if ($contact === null) {
            echo "Contact not found.\n";
            return;
        }

        //Affiche le contact (grâce à __toString() )
        echo $contact . "\n";
    }

    //CREATE contact
    public function create(string $name, string $email, string $phoneNumber) : void 
    {
        //Création d’un objet Contact 
        $contact = new Contact();

        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setPhoneNumber($phoneNumber);

        //Demande au ContactManager d’insérer en base
        $this->contactManager->create($contact);

        echo "Contact created successfully.\n";
    }

    //DELETE contact
    public function delete(int $id): void
    { 
    //Demande à ContactManager de supprimer le contact en base
        $deleted = $this->contactManager->delete($id);
        
        if ($deleted) {
            echo"Contact deleted successfully.\n";
        } else {
            echo "Contact not found.\n";
        }
    }
}