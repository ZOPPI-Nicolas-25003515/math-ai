<?php

namespace App\Controller;

use App\Core\{View,Response};

final class AnalyseiaController
{
    public function analyseiaForm(): void
    {
        echo View::show('Analyseia');
    }
}
