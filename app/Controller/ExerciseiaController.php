<?php
namespace App\Controller;

use Core\View;

final class ExerciseiaController
{
    public function exerciseiaForm(): void
    {
        echo View::show('Exerciceia');
    }
}
