<?php
namespace App\Controller;

use Core\View;
use App\Model\UserRepository;

final class AccountsettingsController {
    public function __construct(private readonly ?UserRepository $repository = null)
    {
        $this->repository ??= new UserRepository();
    }

    public function settingsForm(): void
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

        echo View::show('AccountSettings', [
            'email' => $user->getEmail(),
            'errors' => [],
        ]);
    }

    public function deleteAction(): void
    {
        $email = $_SESSION['email'] ?? null;
        $password = $_POST['password'] ?? '';

        if ($email === null) {
            header('Location: /login');
            exit;
        }

        if (trim((string) $password) === '') {
            echo View::show('AccountSettings', [
                'email' => $email,
                'errors' => ['Le mot de passe est requis pour supprimer le compte.'],
            ]);
            return;
        }

        try {
            $this->repository->deleteUser($email, (string) $password);
        } catch (\InvalidArgumentException $e) {
            echo View::show('AccountSettings', [
                'email' => $email,
                'errors' => [$e->getMessage()],
            ]);
            return;
        }

        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}