<?php
namespace App\Controller;
use App\Model\UserRepository;
use App\Core\{View,Request,Response};

final class ClassaiController
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function classaiForm(): Response
    {
        return $this->view->render('Classai');
    }
}
