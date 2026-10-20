<?php

namespace App\Controller;

use Core\View;

final class AnalyseiaController
{
    public function analyseiaForme(): void
    {
        echo View::show('Analyseia');
    }
}
