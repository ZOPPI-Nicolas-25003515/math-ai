<?php
namespace App\Controller;
use App\Core\{Response, View};
final class LogoutController
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function logoutAction(): Response
    {
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        return $this->view->render('/');
    }
}
