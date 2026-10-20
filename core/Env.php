<?php

namespace Core;

/**
 * Charge les variables d'environnement depuis le fichier .env.
 * Inspiré de https://github.com/hadeli/MVC-Explication/
 */

final class Env
{
    function loadEnv(string $path): void
    {
        if (!is_file($path)) {
            throw new \RuntimeException("Fichier de configuration introuvable : $path\n"
                . "Copiez .env.example vers .env puis adaptez les values.");
        }
        foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $row) {
            // ignorer commentaires, découper sur le premier "=", retirer les guillemets,
            if (str_starts_with($row, '#')) continue;
            [$key, $value] = explode('=', $row, 2);
            // ne rien écraser si la variable existe déjà (getenv() ou $_ENV)...
            if (isset($_ENV[$key])) continue;
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }

    /**
     * Récupère la variable d'environnement demandée et les renvoie
     * (renvoie null si aucune variable n'a été trouvée)
     */

    function get(string $key, string|null $default): ?string
    {
        $value = $_ENV[$key] ?? getenv($key);
        return $value === false ? null : $default;
    }
}
