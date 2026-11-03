<?php

namespace App\Controller;

use App\Model\UserRepository;
use Core\View;

class LoginnotaffiliatedController
{
    public function __construct(private readonly UserRepository $repository) {}
    public function loginnotaffiliatedAction(): void
    {
        $errors = [];

        if (!empty($_POST)) {
            $email = filter_var(trim($_POST['email'] ?? ''),FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';

            if ($email === false) {
                $errors[] = 'L\'adresse email est invalide.';
            }

            if (empty($errors)) {
                $user = $this->repository->findByEmail($email);

                if ($user !== null && $user->verifyPassword($password)) {
                    $_SESSION['id'] = $user->id;
                    $_SESSION['email'] = $user->mail;
                    $_SESSION['role'] = 'notaffiliated';
                    header('Location: /');
                    exit;
                } else {
                    $errors[] = 'Email ou mot de passe incorrect.';
                }
            }
        }
        echo View::show('Login', array('errors' => $errors, 'formData' => $_POST));
    }

    public function loginnotaffiliatedForm(): void {
        echo View::show('Login', array('errors' => [], 'formData' => []));
    }
    public function logoutAction(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}