<?php
namespace App\Controller;
use App\Core\{View,Response};
final class LoginchoiceController
{
    private View $view;

    public function __construct(View $view){
        $this->view = $view;
    }

    public function loginchoiceForm(): Response {
        return $this->view->render('Loginchoice');
    }

}