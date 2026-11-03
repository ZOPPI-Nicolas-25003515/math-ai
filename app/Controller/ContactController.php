<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
final class ContactController{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function contactForm(): Response
    {
        return $this->view->render('Contact');
    }
}
