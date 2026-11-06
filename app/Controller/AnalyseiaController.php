<?php

namespace App\Controller;

use App\Core\{View,Response};

final class AnalyseiaController
{
    private View $view;

    public function __construct(View $view) {
        $this->view = $view;
    }
    public function analyseiaForm(): Response
    {
        $_SESSION['subject']=1;
        return $this->view->render('Analyseia', array('errors' => [], 'formData' => []));
    }
}
