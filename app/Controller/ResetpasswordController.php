<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Model\UserRepository;
use App\Model\UserValidate;

final class ResetpasswordController
{
    private View $view;
    public function __construct(private readonly UserRepository $repository,View $view) {
        $this->view = $view;
    }

    public function resetpasswordAction(Request $request): Response
    {
        $errors = [];
        $password = $request->post('password') ?? '';
        $confirmation = $request->post('confirmation') ?? '';
        $reset_token = $request->post('token') ?? '';
        $userReset = new UserValidate('', $password, $confirmation);

        $errLength = $userReset->checkPasswordLength();
        $errConf = $userReset->passwordConfirmation();
        $errorPassUse = $this->repository -> verifyPasswordUsability($reset_token,$password);
        $errorToken = $this->repository->verifyToken($reset_token);

        if (!empty($errLength)) $errors[] = $errLength;
        if (!empty($errConf)) $errors[] = $errConf;
        if (!empty($errorPassUse)) $errors[] = $errorPassUse;
        if (!empty($errorToken)) $errors[] = $errorToken;

        if (empty($errors)) {
            $user = $this->repository->updateUser($reset_token, $password);
            $request->session['id'] = $user->id;
            $request->session['email'] = $user->email;
            $request->setSession('user', ['id' => $user->id, 'email' => $user->email]);
            Response::redirect('/');
        }
        return $this->view->render('Resetpassword', array('errors' => $errors,'token' => $reset_token, 'formData' => $request->post));
    }

    public function resetpasswordForm(Request $request): Response
    {
        $reset_token = rtrim($request->get('token') ?? '', '"');
        return $this->view->render('Resetpassword', array('errors' => [],'token' => $reset_token, 'formData' => []));
    }
}
