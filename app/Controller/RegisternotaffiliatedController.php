<?php

namespace App\Controller;

use App\Model\UserRepository;
use App\Model\UserValidate;
use Core\View;

class RegisternotaffiliatedController
{
    public function __construct(private readonly UserRepository $repository) {}
    public function registerAction(): void
    {
        $errors = [];
        $success = false;

        if (!empty($_POST)) {
            $email =filter_var(trim($_POST['email'] ?? ''),FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';
            $confirmation = $_POST['confirmation'] ?? '';
            $teachername = $_POST['teachername'] ?? '';
            $surname = $_POST['surname'] ?? '';
            $highschoolid = $_POST['high_school'] ?? '';
            //$s_name = trim($_POST['name'] ?? ''); Nous ajouterons en effet un nom et prénom plus tard.

            $userValidate = new UserValidate($email,$password,$confirmation);

            $emailError = $userValidate->checkEmailValidity();
            $passwordError = $userValidate->checkPasswordLength();
            $confirmationError = $userValidate->passwordConfirmation();

            if (!empty($emailError)) $errors[] = $emailError;
            if (!empty($passwordError)) $errors[] = $passwordError;
            if (!empty($confirmationError)) $errors[] = $confirmationError;


            if (empty($errors)) {
                if ($this->repository->emailExists($email)) {
                    $errors[] = 'Un compte existe déjà avec cet email.';
                }else{
                    $user = $this->repository->createUser($teachername, $surname, $email, $password);
                    $teacher = $this->repository->createNotAffiliated($user->id, $highschoolid);
                    $success = true;
                    $_SESSION['id'] = $user->id;
                    $_SESSION['email'] = $user->mail;
                    $_SESSION['role'] = 'teacher';
                    header('Location: /');
                    exit;
                }
            }
        }
        echo View::show('Registernotaffiliated', array( 'errors' => $errors,'success' => $success, 'formData' => $_POST));
    }
    public function registerForm(): void {
        echo View::show('Registernotaffiliated', array( 'errors' => [],'success' => null, 'formData' => []));
    }
}