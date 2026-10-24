<?php

namespace App\Model;

final class UserFile{

    public function __construct() {}

    public function copyClass(array $fileData): string
    {
        $errors = '';
        $targetfolder = __DIR__ . '/../../resources/Class/';

        if ($fileData['error'] !== UPLOAD_ERR_OK) {
            return "Erreur lors du transfert du fichier.";
        }

        $fileExtension = strtolower(pathinfo($fileData['name'], PATHINFO_EXTENSION));
        if ($fileExtension !== 'pdf') {
            return "Erreur : Seuls les fichiers PDF sont autorisés.";
        }

        if (!file_exists($targetfolder)) {
            mkdir($targetfolder, 0755, true);
        }

        $myfile = basename($fileData['name']);
        $finalpath = $targetfolder . $myfile;

        // 5. Copier le fichier
        if (!move_uploaded_file($fileData['tmp_name'], $finalpath)) {
            $errors = "Erreur : Impossible de déplacer le fichier. Vérifiez les permissions du serveur.";
        }
        return $errors;
    }
}