<?php

namespace Core;

/**
 * Charge les variables d'environnement depuis le fichier .env.
 * Inspiré de https://github.com/hadeli/MVC-Explication/
 */
function chargerEnv(string $chemin): void
{
    if (!is_file($chemin)) {
        throw new \RuntimeException(
            "Fichier de configuration introuvable : $chemin\n" .
            "Copiez .env.example vers .env puis adaptez les valeurs."
        );
    }

    $lignes = file($chemin, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lignes === false) {
        throw new \RuntimeException("Impossible de lire le fichier : $chemin");
    }

    foreach ($lignes as $ligne) {

        // récupère la ligne à partir du premier "=". Si "=" n'est pas présent dans la ligne alors la ligne est ignorée
        $position = strpos($ligne, '=');
        if ($position === false) {
            continue; 
        }

        // extraction de la clé et de la valeur
        $cle = trim(substr($ligne, 0, $position));
        $valeur = trim(substr($ligne, $position + 1));

        // si la clé existe alors ne pas écraser les variables déjà définies
        if (!array_key_exists($cle, $_ENV)) {
            $_ENV[$cle] = $valeur;
            putenv("$cle=$valeur");
        }
    }
}

/**
 * Récupère la variable d'environnement demandée et les renvoie
 * (renvoie null si aucune variable n'a été trouvée)
 */

function env(string $cle): string|null
{

    if (array_key_exists($cle, $_ENV)) {
        return $_ENV[$cle];
    }

    $valeur = getenv($cle);
    if ($valeur !== false) {
        return $valeur;
    }

    return null;
}
