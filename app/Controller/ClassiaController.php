<?php
namespace App\Controller;

use Core\View;

final class ClasssiaController
{
    public function coursiaForme(): void
    {
        echo View::show('Coursia');
    }
}
