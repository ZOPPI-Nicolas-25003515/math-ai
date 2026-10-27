<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Model\UserRepository;
use App\Model\UserMail;
final class ForgottenpasswordteacherController
{
    private View $view;
    public function __construct(private readonly UserRepository $repository, View $view) {
        $this->view = $view;
    }
    public function forgottenpasswordAction(Request $request): Response
    {
        $message = '';
        global $pdo;
        if (!empty($request->post('email'))) {
            $email = filter_var(trim($request->post('email')), FILTER_VALIDATE_EMAIL);
            if (!$this->repository->emailExists($email)) {
                $message = 'Si votre adresse e-mail est correcte, un email de réinitialisation a été envoyé.';
            } else {
                $reset_token = bin2hex(random_bytes(32));
                $timezoneFrance = new \DateTimeZone('Europe/Paris');
                $expiry = (new \DateTimeImmutable('+15 minutes', $timezoneFrance))->format('Y-m-d H:i:s');
                $this->repository->setResetToken($email, $reset_token, $expiry);
                $resetLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://')
                    . ($_SERVER['HTTP_HOST'] ?? 'localhost')
                    . '/resetpassword?reset&token=' . urlencode($reset_token);
                $userMail = new UserMail($email);
                $content = $userMail->createResetPasswordMessage($email, $resetLink);
                if ($userMail->sendMail($content)) {
                    $message = 'Si votre adresse e-mail est correcte, un email de réinitialisation a été envoyé.';
                } else $message = 'Une erreur est survenue lors de l\'envoi de l\'email.';
            }
        }
        return $this->view->render('Forgottenpassword', ['message' => $message, 'formData' => $request->post]);
    }
    public function forgottenpasswordForm(): Response
    {
        return $this->view->render('Forgottenpassword', ['message' => '', 'formData' => []]);
    }
}
