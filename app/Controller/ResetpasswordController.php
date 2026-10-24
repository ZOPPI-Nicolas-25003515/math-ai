<?php
namespace App\Controller;
use Core\View;
use App\Model\UserRepository;
use App\Model\UserValidate;

final class ResetpasswordController
{
    public function __construct(private readonly UserRepository $repository) {}

    public function resetpasswordAction(): void
    {
        $errors = [];
        $message = '';

        if (!empty($_POST)) {
            $password = $_POST['password'] ?? '';
            $confirmation = $_POST['confirmation'] ?? '';
            $reset_token = $_GET['token'] ?? $_POST['reset_token'] ?? '';
            $userReset = new UserValidate('', $password, $confirmation);

            $errLength = $userReset->checkPasswordLength();
            $errConf = $userReset->passwordConfirmation();
            $errorPassUse = $this->repository -> verifyPasswordUsability($reset_token,$password);
            $errorToken = $this->repository -> verifyToken($reset_token);

            if (!empty($errLength)) $errors[] = $errLength;
            if (!empty($errConf)) $errors[] = $errConf;
            if (!empty($errorPassUse)) $errors[] = $errorPassUse;
            if (!empty($errorToken)) $errors[] = $errorToken;

            if (empty($errors)) {
                $user = $this->repository->updateTeacher($reset_token,$password);
                if (!empty($user)) {
                    $_SESSION['id'] = $user->id;
                    $_SESSION['email'] = $user->mail;
                    header('{Location: /home');
                    $message = 'Votre mot de passe a été modifié.';
                    exit;
                }
                else {
                    $errors[] = 'Une erreur est survenue.';
                }
            }
        }
        echo View::show('Resetpassword', array('errors' => $errors, 'formData' => $_POST));
    }

    public function resetpasswordForm(): void{
        echo View::show('Resetpassword', array('errors' => [], 'formData' => []));
    }

}
