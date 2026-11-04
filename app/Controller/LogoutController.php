<?php
namespace App\Controller;
use App\Core\{Response};
final class LogoutController
{
    public static function logoutAction(): Response
    {
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        return Response::redirect('/');
    }
}
