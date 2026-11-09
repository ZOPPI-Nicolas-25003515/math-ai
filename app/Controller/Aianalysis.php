<?php

namespace App\Controller;

use App\Model\UserRepository;
use App\Core\{View,Response};

final class Aianalysis
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function aianalysisForm(): Response
    {
        $_SESSION['subject']=1;
        return $this->view->render('Analyseia', array('errors' => [], 'formData' => []));
    }
}
