<?php
namespace App\Controller;

use Core\View;

final class ClassiaController
{
    public function classiaForm(): void
    {
        echo View::show('Classia');
    }
}