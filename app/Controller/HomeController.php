<?php
namespace App\Controller;
use Core\{View,Request,Response};

final class HomeController{
    public function homeForm(): Response
    {
        return View::render('Home', []);
    }
}
