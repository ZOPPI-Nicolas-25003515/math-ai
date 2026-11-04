<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
final class MentionsController
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function mentionsForm(): Response
    {
        return $this->view->render('Mentions');
    }
}
