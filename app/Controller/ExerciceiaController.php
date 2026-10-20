<?php
namespace App\Controller;

use Core\View;

final class ExerciceiaController
{
    public function exerciceiaForme(): void
    {
        echo View::show('Exerciceia');
    }
}