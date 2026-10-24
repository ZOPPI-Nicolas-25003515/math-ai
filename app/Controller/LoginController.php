<?php
namespace App\Controller;
use Core\View;
use App\Model\UserRepository;
final class LoginController
{
    public function __construct(private readonly UserRepository $repository) {}
    public function loginAction(): void
    {
        $errors = [];

        if (!empty($_POST)) {
            $email = filter_var(trim($_POST['email'] ?? ''),FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';
            
            if ($email === false) {
                $errors[] = 'L\'adresse email est invalide.';
            }

            if (empty($errors)) {
                $teacher = $this->repository->findByEmail($email);

                if ($teacher !== null && $teacher->verifyPassword($password)) {
                    $_SESSION['id'] = $teacher->id;
                    $_SESSION['email'] = $teacher->mail;
                    header('Location: /');
                    exit;
                } else {
                    $errors[] = 'Email ou mot de passe incorrect.';
                }
            }
        }
        echo View::show('Login', array('errors' => $errors, 'formData' => $_POST));
    }

    public function loginForm(): void {
        echo View::show('Login', array('errors' => [], 'formData' => []));
    }
    public function logoutAction(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}
