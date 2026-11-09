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

        if (!empty($request->post)) {
            $email = filter_var(trim($request->post('email') ?? ''), FILTER_VALIDATE_EMAIL);
            $password = $request->post('password') ?? '';
            $confirmation = $request->post('confirmation') ?? '';
            $teachername = $_POST['name'] ?? '';
            $surname = $_POST['surname'] ?? '';

            $userValidate = new UserValidate($email, $password, $confirmation);

            $emailError = $userValidate->checkEmailValidity();
            $passwordError = $userValidate->checkPasswordLength();
            $confirmationError = $userValidate->passwordConfirmation();

            if (!empty($emailError)) $errors[] = $emailError;
            if (!empty($passwordError)) $errors[] = $passwordError;
            if (!empty($confirmationError)) $errors[] = $confirmationError;


            if (empty($errors)) {
                if ($this->repository->emailExists($email)) {
                    $errors[] = 'Un compte existe déjà avec cet email.';
                } else {
                    $user = $this->repository->createUser($teachername, $surname, $email, $password);
                    $teacher = $this->repository->createNotAffiliated($user->id);
                    $request->setSession('id', $user->id);
                    $request->setSession('email', $user->mail);
                    $request->setSession('user', ['id' => $user->id, 'email' => $user->mail, 'role' => 'not_affiliated']);
                    return Response::redirect('/');
                }
            }
        }
        return $this->view->render('Register', array('errors' => $errors, 'formData' => $request->post));
    }


    public function registerForm(): Response
    {
        return $this->view->render('Register', array('errors' => [], 'formData' => []));
    }
}