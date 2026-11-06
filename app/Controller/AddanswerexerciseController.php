<?php

namespace App\Controller;

use App\Core\{View,Response};
final class AddanswerexerciseController
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function addanswerexerciseForm(): Response
    {
        $type = $_POST['type'] ?? '';
        return $this->view->render('Addanswerexercise', ['errors' => [''], array( 'type' => $type,)]);
    }
}