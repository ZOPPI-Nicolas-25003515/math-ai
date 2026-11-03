<?php
namespace App\Controller;
use Core\View;
final class LoginchoiceController
{

    public function loginchoiceForm(): void {
        echo View::show('Loginchoice', array('errors' => [], 'formData' => []));
    }

}