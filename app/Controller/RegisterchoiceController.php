<?php
namespace App\Controller;
use Core\View;
final class RegisterchoiceController
{

    public function registerchoiceForm(): void {
        echo View::show('Registerchoice', array('errors' => [], 'formData' => []));
    }

}