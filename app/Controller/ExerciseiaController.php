<?php
namespace App\Controller;
use App\Core\{View,Request,Response};

final class ExerciseiaController
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function exerciseiaForm(): Response
    {
        return $this->view->render('Exerciceia');
    }
}
