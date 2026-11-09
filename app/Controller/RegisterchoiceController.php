<?php
namespace App\Controller;
use \App\Core\{View,Response};
final class RegisterchoiceController
{
    private $view;

    public function __construct(View $view){
        $this->view = $view;
    }

    public function registerchoiceForm(): Response {
        return $this->view->render('Registerchoice');
    }

}