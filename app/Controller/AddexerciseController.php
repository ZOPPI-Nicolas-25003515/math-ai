<?php

namespace App\Controller;

use App\Model\UserRepository;
use App\Model\UserValidate;
use Core\View;

final class AddexerciseController
{
    public function addexerciseForm(): void
    {
        echo View::show('Addexercise');
    }
}
