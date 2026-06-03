<?php

namespace Johan\ContactCli\Config;

//Charge les variables d'environnement depuis un fichier .env
class EnvLoader
{
    public static function load(string $filePath): void
    {
        //Arrête le chargement si le fichier n'existe pas
        if (!file_exists($filePath)) {
            return;
        }

        //Lit le fichier ligne par ligne en ignorant les lignes vides
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {

            //Ignore les commentaires commençant par #
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            //Sépare la clé et la valeur de chaque variable (ex : DB_HOST=localhost)
            [$key, $value] = explode('=', $line, 2);

            //Stocke la variable dans le tableau global $_ENV
            $_ENV[trim($key)] = trim($value);
        }
    }
}