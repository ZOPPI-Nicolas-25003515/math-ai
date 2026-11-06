<?php

namespace App\Controller;

use App\Model\UserFile;
use App\Model\UserRepository;
use App\Core\{View,Request,Response};

final class AddclassroomController
{
    private View $view;

    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }
    public function addclassroomAction(Request $request): Response
    {
        return Response::redirect('/');
    }
    public function addclassroomForm(): Response
    {
        return $this->view->render('Addclass', array('errors' => [], 'formData' => []));
    }
}