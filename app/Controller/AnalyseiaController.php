<?php

namespace App\Controller;

use App\Core\{View,Response};

final class AnalyseiaController
{
    public function analyseiaForm(): void
    {
        $_SESSION['subject']=1;
        echo View::show('Analyseia');
    }
}
