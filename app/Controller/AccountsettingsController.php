<?php
namespace App\Controller;

use App\Core\{View,Request,Response};
use App\Model\UserRepository;

final class AccountsettingsController {

    private View $view;
    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }
    public function settingsForm(Request $request): Response
    {
        $email = $request->session('email');

        if ($email === null) {
            return Response::redirect('/login');
        }

        $user = $this->repository->findByEmail($email);

        if ($user === null) {
            unset($_SESSION['email'], $_SESSION['id']);
            return Response::redirect('/login');
        }
        return $this->view->render('AccountSettings', ['errors' => [], 'email' => $user->getEmail()]);
    }

    public function deleteAction(Request $request): Response
    {
        $email = $request->session('email');
        $password = $request->session('password');


        if ($email === null) {
            return Response::redirect('/login');
        }

        if (trim((string) $password) === '') {
            return $this->view->render('AccountSettings', ['errors' => ['Le mot de passe est requis pour supprimer le compte.'], 'email' =>$email]);
        }

        try {
            $this->repository->deleteUser($email, (string) $password);
        } catch (\InvalidArgumentException $e) {
            return $this->view->render('AccountSettings', ['errors' => [$e->getMessage()], 'email' =>$email]);
        }

        session_unset();
        session_destroy();
        return Response::redirect('/');
    }
}