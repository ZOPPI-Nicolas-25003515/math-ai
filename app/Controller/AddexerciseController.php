<?php

namespace App\Controller;

use App\Model\UserFile;
use App\Model\UserRepository;
use App\Model\UserValidate;
use Core\View;

final class AddexerciseController
{
    public function __construct(private readonly UserRepository $repository) {}

    public function addexerciseAction(): void
    {
        $errors = [];
        $success = false;

        if (!empty($_POST)) {

            $subject = isset($_POST['subject']) ? (int) $_POST['subject'] : 0;

            if ($subject <= 0) {
                $errors[] = 'Veuillez sélectionner un sujet valide.';
            }

            $teacherid = (int) $_SESSION['id'];
            $type = $_POST['type'] ?? '';
            $difficulty = $_POST['difficulty'] ?? '';

            $fileData = $_FILES['pdf_file'] ?? [];
            $path = $fileData['name'] ?? '';

            $userFile = new UserFile();

            $fileError = $userFile->copyExerciseS($_FILES['pdf_file']);

            if ($teacherid <= 0) {
                $errors[] = 'Vous devez être connecté en tant que professeur pour ajouter un cours.';
            }

            if (!empty($fileError)) $errors[] = $fileError;

            if (empty($errors)) {
                if ($this->repository->pathExerciseExists($path,$teacherid)) {
                    $errors[] = 'Un de vos exercice à deja ce nom';
                }else{
                    $exercise = $this->repository->createExercise($teacherid,$subject,$path,$type,$difficulty);
                    $success = true;
                    header('/answerexercise');
                    exit;
                }
            }
        }
        echo View::show('Addclass', array( 'errors' => $errors,'success' => $success, 'formData' => $_POST));
    }
    public function addexerciseForm(): void
    {
        echo View::show('Addexercise');
    }
}
