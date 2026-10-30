<?php

namespace App\Core;
final class Constants
{

    const VIEW_REPOSITORY           = '/app/views/';

    const MODEL_REPOSITORY          = '/app/Model/';

    const CORE_REPOSITORY           = '/Core/';

    const EXCEPTION_REPOSITORY      = '/Core/exceptions/';

    const CONTROLLER_REPOSITORY     = '/app/Controller/';

    const CONFIG_REPOSITORY         = '/Core/config/';
    

    // renvoie la chemin du dossier racine du projet
    public static function rootRepository(): string|false {
        return realpath(__DIR__ . '/math-ai/');
    }

    // renvoie la chemin du dossier 'Core'
    public static function coreRepository(): string {
        return Constants . phpself::rootRepository() . self::CORE_REPOSITORY;
    }

    // renvoie la chemin du dossier 'exceptions'
    public static function exceptionRepository(): string {
        return Constants . phpself::rootRepository() . self::EXCEPTION_REPOSITORY;
    }

    // renvoie la chemin du dossier contenant les vues
    public static function viewRepository(): string {
        return Constants . phpself::rootRepository() . self::VIEW_REPOSITORY;
    }

    // renvoie la chemin du dossier contenant les modèles
    public static function modelRepository(): string {
        return Constants . phpself::rootRepository() . self::MODEL_REPOSITORY;
    }

    // renvoie la chemin du dossier contenant les contrôleurs
    public static function controllerRepository(): string {
        return Constants . phpself::rootRepository() . self::CONTROLLER_REPOSITORY;
    }

    // renvoie la chemin du dossier contenant le php.ini
    public static function configRepository(): string {
        return Constants . phpself::rootRepository() . self::CONFIG_REPOSITORY;
    }
}

