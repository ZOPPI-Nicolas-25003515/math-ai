<?php

namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Model\UserRepository;
use App\Model\UserValidate;

final class RegisternotaffiliatedController
{
    private View $view;
    public function __construct(private readonly UserRepository $repository,View $view) {
        $this->view = $view;
    }
    public function registernotaffiliatedAction(): Response
    {
        $errors = [];
        $success = false;

        if (!empty($_POST)) {
            $email =filter_var(trim($_POST['email'] ?? ''),FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';
            $confirmation = $_POST['confirmation'] ?? '';
            $teachername = $_POST['name'] ?? '';
            $surname = $_POST['surname'] ?? '';
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
                    $teacher = $this->repository->createNotAffiliated($user->id);
                    $success = true;
                    $_SESSION['id'] = $user->id;
                    $_SESSION['email'] = $user->mail;
                    $_SESSION['role'] = 'notaffiliated';
                    header('Location: /');
                    exit;
                }
            }
        }
        return $this->view->render('Register', array( 'errors' => $errors, 'formData' => $_POST));
    }
    public function registerForm(): Response {
        return $this->view->render('Register', array( 'errors' => [], 'formData' => []));
    }
}