<?php
namespace Core;
final class AutoLoader {
    public static function findClass(string $class): void {
        $class[0] = strtolower($class[0]); //Enlever la lettre majuscule
        $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
        if (is_file($file)) {
            require $file;
        }
    }
}
spl_autoload_register(['Core\AutoLoader', 'findClass']);




