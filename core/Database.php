<?php

namespace Core;
use PDO;
use PDOException;
final class Database {
    private static ?PDO $pdo = null;
    public static function connexion(): PDO{
        Env::load(__DIR__.'/../.env');
        try {
            // Construction du DSN (Data Source Name)
            $dsn = Env::get('DB_DRIVER') . ':dbname=' . Env::get('DB_NAME') . ';host=' . Env::get('DB_HOST') . ';charset=utf8mb4';

            // Options PDO pour plus de sécurité
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            // Création de la connexion PDO
            self::$pdo = new PDO($dsn,Env::get('DB_USERNAME'),Env::get('DB_PASSWORD'),$options);
            // Création de la table users
            self::$pdo->exec('CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(250) NOT NULL,
        PRIMARY KEY(id),reset_token VARCHAR(255), reset_token_expiry DATETIME
    )');
            return self::$pdo;

        }catch (PDOException $e){
            die ("Error :". $e->getMessage());
        }

    }
}



