<?php
namespace App\Controller;
use App\Core\{View,Request,Response};

final class ClassiaController
{
    public function classiaForm(): void
    {
        echo View::show('Classia');
    }
}
