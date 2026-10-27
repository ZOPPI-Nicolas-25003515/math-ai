<?php
namespace App\Controller;
use Core\{View,Response};

final class HomeController{
    private View $view;

    public function __construct(View $view){
        $this->view = $view;
    }
    public function homeForm(): Response
    {
        return $this->view->render('Home');
    }
}
