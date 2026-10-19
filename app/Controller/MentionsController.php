<?php
namespace App\Controller;
use Core\View;
final class MentionsController
{
    public function mentionsForm(): void
    {
        echo View::show('Mentions');
    }
}
