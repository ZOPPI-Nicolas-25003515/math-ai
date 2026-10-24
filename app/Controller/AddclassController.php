<?php

namespace App\Controller;

use App\Model\UserFile;
use App\Model\UserRepository;
use Core\View;

class AddclassController
{

    public function __construct(private readonly UserRepository $repository) {}

    public function addclassAction(): void
    {
        $errors = [];
        $success = false;

        if (!empty($_POST)) {

            $subject = isset($_POST['subject']) ? (int) $_POST['subject'] : 0;
            if ($subject <= 0) {
                $errors[] = 'Veuillez sélectionner un sujet valide.';
            }

            $title = $_POST['titre_cours'] ?? '';
            $teacherid = (int) $_SESSION['id'];

            $fileData = $_FILES['pdf_file'] ?? [];
            $path = $fileData['name'] ?? '';

            $userFile = new UserFile();

            $fileError = $userFile->copyClass($_FILES['pdf_file']);

            if (!empty($fileError)) $errors[] = $fileError;

            if (empty($errors)) {
                if ($this->repository->pathExists($path,$teacherid)) {
                    $errors[] = 'Un de vos cours à deja ce nom';
                }else{
                    var_dump([
                        'path' => $path,
                        'teacher_id' => $teacherid,
                        'title' => $title,
                        'subject_id' => $subject,
                        'POST_brut' => $_POST['subject'] ?? 'non défini'
                    ]);
                    $class = $this->repository->createClass($path,$teacherid,$title,$subject);
                    $success = true;
                    header('Location: /');
                    exit;
                }
            }
        }
        echo View::show('Addclass', array( 'errors' => $errors,'success' => $success, 'formData' => $_POST));
    }
    public function addclassForm(): void
    {
        echo View::show('Addclass');
    }
}
