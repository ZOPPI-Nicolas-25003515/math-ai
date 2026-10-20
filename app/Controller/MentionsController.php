<?php
namespace App\Controller;
use Core\{View,Request,Response};
final class MentionsController
{
    public function mentionsForm(): void
    {
        echo View::show('Mentions');
    }
}
