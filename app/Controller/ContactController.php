<?php
namespace App\Controller;
use Core\View;
final class ContactController{

    public function contactForm(): void{
        echo View::show('Contact');
    }
}
