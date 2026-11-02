<?php

namespace App\Controller;

use Core\View;

final class AnalyseiaController
{
    public function analyseiaForm(): void
    {
        echo View::show('Analyseia');
    }
}
