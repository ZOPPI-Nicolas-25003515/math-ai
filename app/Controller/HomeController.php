<?php
namespace App\Controller;
use Core\View;
final class HomeController{
    public function homeForm(): void
    {
        echo View::show('Home');
    }
}
