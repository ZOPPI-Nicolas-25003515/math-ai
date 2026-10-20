<?php
namespace App\Controller;
use Core\{View,Request,Response};
final class ContactController{

    public function contactForm(): void{
        echo View::show('Contact');
    }
}
