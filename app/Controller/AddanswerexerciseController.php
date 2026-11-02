<?php

namespace App\Controller;
use Core\View;
class AddanswerexerciseController
{

    public function addanswerexerciseForm(): void
    {
        $type = $_POST['type'] ?? '';
        echo View::show('Addanswerexercise',array( 'type' => $type,));
    }
}