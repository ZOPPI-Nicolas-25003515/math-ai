<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
final class ContactController{

    public function contactForm(): Response
    {
        return View::render('Contact');
    }
}
