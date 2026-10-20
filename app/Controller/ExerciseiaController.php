<?php
namespace App\Controller;

use Core\View;

final class ExerciseiaController
{
    public function exerciseiaForme(): void
    {
        echo View::show('Exerciceia');
    }
}
