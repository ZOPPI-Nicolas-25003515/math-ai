<?php

namespace App\Controller;

use Core\View;

final class AnalyseiaController
{
    public function analyseiaForm(): void
    {
        $_SESSION['subject']=1;
        echo View::show('Analyseia');
    }
}
