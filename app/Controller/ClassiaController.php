<?php
namespace App\Controller;

use Core\View;

final class ClasssiaController
{
    public function classiaForm(): void
    {
        echo View::show('Coursia');
    }
}
