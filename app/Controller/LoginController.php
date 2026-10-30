<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Model\UserRepository;
final class LoginController
{
    private View $view;
    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }
    public function loginAction(Request $request): Response
    {
        $errors = [];

        $email = $request->post('email');
        $password = $request->post('password');
        $user = $this->repository->findByEmail($email);
        if ($user !== null && $user->verifyPassword($password)) {
            $request->setSession('user', ['id' => $user->id, 'email' => $user->email]);
            return Response::redirect('/');
        }
        return $this->view->render('Login', ['error' => 'Email ou mot de passe incorrect.', 'email' => $email]);
    }
    public function loginForm(): Response {
        return $this->view->render('Login', array('errors' => [], 'formData' => []));
    }
    public function logoutAction(Request $request): Response
    {
        session_destroy();
        unset($request);
        return Response::redirect('/');
    }
}
