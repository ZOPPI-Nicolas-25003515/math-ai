<?php
namespace App\Controller;
use App\Core\{View,Request,Response};

final class ClasssiaController
{
    public function classiaForm(): void
    {
        echo View::show('Coursia');
    }
}
