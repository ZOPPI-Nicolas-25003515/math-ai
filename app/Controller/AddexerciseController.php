<?php

namespace App\Controller;

use App\Model\UserFile;
use App\Model\UserRepository;
use App\Core\{View,Request,Response};

final class AddexerciseController
{
    private View $view;

    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }
    public function addexerciseAction(Request $request): Response
    {
        $errors = [];
        $success = false;

        if (!empty($_POST)) {

            $subject =(int) $request->post('subject');

            if (empty($subject)) {
                $errors[] = 'Veuillez sélectionner un sujet valide.';
            }

            $type = $request->post('type');
            $difficulty = $request->post('difficulty');
            $teacherid = (int) $request->session('id');

            $fileData = $_FILES['pdf_file'] ?? [];
            $path = $fileData['name'] ?? '';

            $userFile = new UserFile();

            $fileError = $userFile->copyExerciseS($_FILES['pdf_file']);

            if (empty($teacherid)) {
                $errors[] = 'Vous devez être connecté en tant que professeur pour ajouter un exercise.';
            }

            if (!empty($fileError)) $errors[] = $fileError;

            if (empty($errors)) {
                if ($this->repository->pathExerciseExists($path,$teacherid)) {
                    $errors[] = 'Un de vos exercice à deja ce nom';
                }else{
                    $exercise = $this->repository->createExercise($teacherid,$subject,$path,$type,$difficulty);
                    return Response::redirect('/answerexercise');
                }
            }
        }
        return $this->view->render('Addclass', array('errors' => [$errors], 'formData' => [$_POST]));
    }

    public function addexerciseForm(): Response
    {
        return $this->view->render('Addexercise', array('errors' => [], 'formData' => []));
    }
}
