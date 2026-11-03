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
        $email = $_SESSION['email'] ?? null;

        if ($email === null) {
            header('Location: /login');
            exit;
        }

        $user = $this->repository->findByEmail($email);

        if ($user === null) {
            unset($_SESSION['email'], $_SESSION['id']);
            header('Location: /login');
            exit;
        }

        return $this->view->render('Settings', [
            'email' => $user->getEmail(),
            'errors' => [],
        ]);
    }

    public function deleteAction(): Response
    {
        $email = $_SESSION['email'] ?? null;
        $password = $_POST['password'] ?? '';

        if ($email === null) {
            header('Location: /login');
            exit;
        }

        if (trim((string) $password) === '') {
            return $this->view->render('Settings', [
                'email' => $email,
                'errors' => ['Le mot de passe est requis pour supprimer le compte.'],
            ]);
        }

        try {
            $this->repository->deleteUser($email, (string) $password);
        } catch (\InvalidArgumentException $e) {
            return $this->view->render('Settings', [
                'email' => $email,
                'errors' => [$e->getMessage()],
            ]);
        }

        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}