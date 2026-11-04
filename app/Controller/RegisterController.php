<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Model\UserRepository;
use App\Model\UserValidate;
final class RegisterController {
    private View $view;
    public function __construct(private readonly UserRepository $repository,View $view) {
        $this->view = $view;
    }
    public function registerAction(Request $request): Response
    {
        $errors = [];

        if (!empty($request->post)) {
            $email =filter_var(trim($request->post('email') ?? ''),FILTER_VALIDATE_EMAIL);
            $password = $request->post('password') ?? '';
            $confirmation = $request->post('confirmation') ?? '';

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
                    $user = $this->repository->createUser($email, $password);
                    $request->setSession('id', $user->id);
                    $request->setSession('email', $user->email);
                    $request->setSession('user', ['id' => $user->id, 'email' => $user->email]);
                    return Response::redirect('/');
                }
            }
        }
        return $this->view->render('Register', array( 'errors' => $errors, 'formData' => $request->post));
    }
    public function registerForm(): Response {
        return $this->view->render('Register', array( 'errors' => [], 'formData' => []));
    }
}
