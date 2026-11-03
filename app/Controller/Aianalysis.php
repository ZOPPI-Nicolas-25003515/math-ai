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
        return $this->view->render('Aianalysis');
    }
}
