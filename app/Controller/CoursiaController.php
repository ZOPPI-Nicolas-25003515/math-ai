<?php
namespace App\Controller;

use Core\View;

final class CoursiaController
{
    public function coursiaForme(): void
    {
        echo View::show('Coursia');
    }
}