<?php

require_once "src/Command/Command.php";

//class Console gère l'exécution de l'application en ligne de commande.
//Elle lit les entrées utilisateur, détecte les commandes et délègue l'exécution à la classe Command.

class Console
{
    //Instance de Command qui centralise l'exécution des actions (list, detail, etc.)
    private Command $command;

    public function __construct()
    {
        //Instancie Command une seule fois pour toute la durée du programme
        $this->command = new Command();
    }

    //Lance la boucle principale de l'application CLI.
    public function run(): void
    {
        //Boucle infinie CLI
        while (true) {

            $line = readline("Enter your command (list, detail, create, delete, modify, help, quit): ");

            //LIST contacts
            if ($line === "list") {
                $this->command->list();
                continue;
            }

            //DETAIL contacts (ex detail 2)
            if (preg_match('/^detail\s+(\d+)$/', $line, $matches)) {
                $id = (int)$matches[1];
                $this->command->detail($id);
                continue;
            }

            //CREATE contact
            if (preg_match('/^create\s+(.+),\s*(.+),\s*(.+)$/', $line, $matches)) {
                $name = $matches[1];
                $email = $matches[2];
                $phone = $matches[3];

                $this->command->create($name, $email, $phone);
                continue;
            }

            //DELETE contact
            if (preg_match('/^delete\s+(\d+)$/', $line, $matches)) {
                $id = (int)$matches[1];
                $this->command->delete($id);
                continue;
            }

            //MODIFY contact
            if (preg_match('/^modify\s+(\d+),\s*(.+),\s*(.+),\s*(.+)$/', $line, $matches)) {
                $id = (int)$matches[1];
                $name = $matches[2];
                $email = $matches[3];
                $phone = $matches[4];

                $this->command->modify($id, $name, $email, $phone);
                continue;
            }

            //HELP
            if ($line === "help") {
                $this->command->help();
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
    }
}