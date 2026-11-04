<?php
namespace App\Core;
/*
 * Permet d'éviter les require_once pour chaque fichier à classe dans les controllers, ce qui rend le programme plus propre
 * et permet l'utilisation des use et namespace, plus simples et rapides
 */

final class AutoLoader {
    public static function findClass(string $class): void {
        $class[0] = strtolower($class[0]); //Enlever la lettre majuscule
        $file = __DIR__ . '/math-ai/' . str_replace('\\', '/', $class) . '.php';
        if (is_file($file)) {
            require $file;
        }
    }
}
spl_autoload_register(['App\Core\AutoLoader', 'findClass']);




