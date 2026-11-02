<?php
namespace App\Controller;
use Core\View;
final class LoginchoiceController
{

    public function loginteacherForm(): void {
        echo View::show('Loginchoice', array('errors' => [], 'formData' => []));
    }

}