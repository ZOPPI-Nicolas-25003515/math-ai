<?php
namespace App\Controller;

use App\Core\{View,Request,Response};
use App\Model\UserRepository;

final class SettingsController {
    private View $view;
    public function __construct(private readonly UserRepository $repository,View $view) {
        $this->view = $view;
    }
    public function settingsForm(): Response
    {
        return $this->view->render('Settings',['errors' => []]);
    }

    public function deleteAction(Request $request): Response
    {
        $email = $request->session('user')['email'];
        $password = $request->post('password');
        $user = $this->repository->findByEmail($email);
        if ($user !== null && $user->verifyPassword($password)) {
            session_unset();
            session_destroy();
            $this->repository->deleteUser($email, $password);
            return Response::redirect('/');
        }

        return $this->view->render('Settings', [
            'email' => $email,
            'errors' => ['Mot de passe incorrect.'],
        ]);
    }
}