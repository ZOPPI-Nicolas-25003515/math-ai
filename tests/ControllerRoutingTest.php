<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/Model/User.php';
require_once __DIR__ . '/../app/Model/UserRepository.php';
require_once __DIR__ . '/../Core/AutoLoader.php';

class FakeUserRepositoryStatement
{
    public function __construct(private object $pdo, private string $sql) {}

    public function execute(array $params = []): bool
    {
        if (str_starts_with($this->sql, 'SELECT id,email,password')) {
            $email = $params['email'] ?? null;
            $this->pdo->lastFetch = $this->pdo->users[$email] ?? false;
            return true;
        }

        if (str_starts_with($this->sql, 'DELETE FROM users')) {
            $email = $params['email'] ?? null;
            unset($this->pdo->users[$email]);
            return true;
        }

        return true;
    }

    public function fetch(int $mode = PDO::FETCH_DEFAULT)
    {
        $value = $this->pdo->lastFetch;
        $this->pdo->lastFetch = null;
        return $value;
    }
}

class FakeUserRepositoryPDO
{
    public array $users = [];
    public mixed $lastFetch = null;

    public function prepare(string $sql): FakeUserRepositoryStatement
    {
        return new FakeUserRepositoryStatement($this, $sql);
    }
}

final class ControllerRoutingTest extends TestCase
{
    public function testLoginRouteUsesLoginAction(): void
    {
        $controller = new Controller('login', []);

        ob_start();
        $controller->execute();
        $output = ob_get_clean();

        $this->assertStringContainsString('Connexion', $output);
    }

    public function testRegisterRouteUsesRegisterAction(): void
    {
        $controller = new Controller('register', []);

        ob_start();
        $controller->execute();
        $output = ob_get_clean();

        $this->assertStringContainsString('Inscription', $output);
    }

    public function testSitemapRouteUsesSitemapAction(): void
    {
        $controller = new Controller('sitemap', []);

        ob_start();
        $controller->execute();
        $output = ob_get_clean();

        $this->assertStringContainsString('Plan du site', $output);
    }

    public function testMentionsRouteUsesMentionsAction(): void
    {
        $controller = new Controller('mentions', []);

        ob_start();
        $controller->execute();
        $output = ob_get_clean();

        $this->assertStringContainsString('Mentions', $output);
    }

    public function testContactRouteUsesContactAction(): void
    {
        $controller = new Controller('contact', []);

        ob_start();
        $controller->execute();
        $output = ob_get_clean();

        $this->assertStringContainsString('Nous contacter', $output);
    }

    public function testUserMailCreateResetPasswordMessageReturnsStructuredContent(): void
    {
        $mail = new UserMail('alice@example.com');
        $content = $mail->createResetPasswordMessage('alice@example.com', 'https://example.com/reset?token=abc123');

        $this->assertSame('Réinitialisation de votre mot de passe', $content['subject']);
        $this->assertStringContainsString('https://example.com/reset?token=abc123', $content['message']);
        $this->assertStringContainsString('Bonjour', $content['message']);
    }

    public function testDeleteUserRemovesMatchingUser(): void
    {
        $pdo = new FakeUserRepositoryPDO();
        $pdo->users['alice@example.com'] = [
            'id' => 1,
            'email' => 'alice@example.com',
            'password' => password_hash('secret123', PASSWORD_DEFAULT),
        ];

        $repository = new \App\Model\UserRepository($pdo);
        $deleted = $repository->deleteUser('alice@example.com', 'secret123');

        $this->assertSame('alice@example.com', $deleted->email);
        $this->assertNull($repository->findByEmail('alice@example.com'));
    }
}
