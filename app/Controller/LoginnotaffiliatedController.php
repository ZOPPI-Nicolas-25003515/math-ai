<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Model\UserRepository;

final class LoginnotaffiliatedController
{
    private View $view;
    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }
    public function loginnotaffiliatedAction(Request $request):  Response    {

        $email = $request->post('email');
        $password = $request->post('password');
        $user = $this->repository->findByEmail($email);

        if ($user !== null && $user->verifyPassword($password)) {
            $request->setSession('user', ['id' => $user->id, 'email' => $user->mail, 'role' => 'notaffiliated']);
            return Response::redirect('/');
        }
        return $this->view->render('Login', ['errors' => ['Email ou mot de passe incorrect.'], 'email' => $email]);
    }

    public function loginnotaffiliatedForm(): Response {
        return $this->view->render('Login', array('errors' => [], 'formData' => []));
    }
}