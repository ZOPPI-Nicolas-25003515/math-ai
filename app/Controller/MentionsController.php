<?php
namespace App\Controller;
use Core\{View,Request,Response};
final class MentionsController
{
    public function mentionsForm(): Response
    {
        return View::render('Mentions');
    }
}
