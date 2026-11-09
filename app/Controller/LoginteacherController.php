<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Model\UserRepository;
final class LoginteacherController
{
    private View $view;
    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }
    public function loginteacherAction(Request $request): Response
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $user = $this->repository->findByEmail($email);
        if ($user !== null && $user->verifyPassword($password)) {
            $request->setSession('user', ['id' => $user->id, 'email' => $user->mail, 'role' => 'teacher']);
            return Response::redirect('/');
        }
        return $this->view->render('Loginteacher', ['errors' => ['Email ou mot de passe incorrect.'], 'email' => $email]);
    }
    public function loginteacherForm(): Response {
        return $this->view->render('Loginteacher', array('errors' => [], 'formData' => []));
    }
}
