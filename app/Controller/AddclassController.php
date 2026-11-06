<?php

namespace App\Controller;

use App\Model\UserFile;
use App\Model\UserRepository;
use App\Core\{View,Request,Response};

final class AddclassController
{
    private View $view;

    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }

    public function addclassAction(Request $request): Response
    {
        $subject =(int) $request->post('subject');
        if (empty($subject)) {
            $errors[] = 'Veuillez sélectionner un sujet valide.';
        }

        $title = $request->post('titre_cours');
        $teacherid = (int) $request->session('id');

        $fileData = $_FILES['pdf_file'] ?? [];
        $path = $fileData['name'] ?? '';

        $userFile = new UserFile();

        $fileError = $userFile->copyClass($_FILES['pdf_file']);

        if (empty($teacherid)) {
            $errors[] = 'Vous devez être connecté en tant que professeur pour ajouter un cours.';
        }

        if (!empty($fileError)) $errors[] = $fileError;

        if (empty($errors)) {
            if ($this->repository->pathExists($path,$teacherid)) {
                $errors[] = 'Un de vos cours à deja ce nom';
            }else{
                $class = $this->repository->createClass($path,$teacherid,$title,$subject);
                return Response::redirect('/');
            }
        }
        return $this->view->render('Addclass', ['errors' => [$errors], 'formData' => $_POST]);
    }
    public function addclassForm(): Response
    {
        return $this->view->render('Addclass', array('errors' => [], 'formData' => []));
    }
}
