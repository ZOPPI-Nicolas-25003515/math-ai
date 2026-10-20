<?php
namespace App\Controller;
use Core\{View,Request,Response};
final class ContactController{

    public function contactForm(): Response
    {
        return View::render('Contact');
    }
}
