<?php
namespace App\Controller;
use App\Core\{View,Response};

final class ClassiaController
{
    private View $view;

    public function __construct(View $view) {
        $this->view = $view;
    }
    public function classiaForm(): Response
    {
        return $this->view->render('Classia', array('errors' => [], 'formData' => []));
    }
}