<?php
namespace App\Model;
use Nette\Utils\DateTime;
use Core\Db;
final class UserRepository {
    public \PDO $pdo;
    public function __construct(?\PDO $pdo = null) {
        $this->pdo =$pdo ?? Db::getPdo();
    }


    public function findByEmail(string $email): ?User{
        $stmt = $this->pdo->prepare('SELECT id,email,password FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$user){return null;}
        else{return new User($user['id'], $user['email'], $user['password']);}
    }

    public function emailExists(string $email): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ? true : false;
    }

    public function createUser(string $email, string $password): User {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->execute(['email' => $email, 'password' => $hashed_password]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new User ($id, $email, $hashed_password);
    }

    public function deleteUser(string $email, string $password): User {
        $user = $this->findByEmail($email);
        if ($user === null) {
            throw new \InvalidArgumentException('Aucun utilisateur trouvé pour cet email.');
        }

        if (!$user->verifyPassword($password)) {
            throw new \InvalidArgumentException('Le mot de passe est incorrect.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        return $user;
    }

    public function updateUser(string $reset_token, string $password): User {
        $user = $this->findByToken($reset_token);
        if ($user === null) {
            throw new \InvalidArgumentException('Aucun utilisateur trouvé pour ce token.');
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('UPDATE users SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :reset_token');
        $stmt->execute(['password' => $hashed_password,'reset_token' => $reset_token]);
        $id = $user->getId();
        $email = $user->getEmail();
        return new User ($id, $email, $hashed_password);
    }

    public function setResetToken(string $email,string $reset_token,string $expiry): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET reset_token = :token, reset_token_expiry = :expiry WHERE email = :email');
        return $stmt->execute(['token' => $reset_token, 'expiry' => $expiry,'email' => $email]);
    }

    public function findByToken(string $reset_token): ?User {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE reset_token = :token');
        $stmt->execute(['token' => $reset_token]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$user) return null;
        else return new User($user['id'], $user['email'], $user['password']);
    }

    public function verifyPasswordUsability(string $reset_token,string $password): ?string {
        $stmt = $this->pdo->prepare('SELECT password FROM users WHERE reset_token = :reset_token');
        $stmt->execute(['reset_token' => $reset_token]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password']))
            return 'Veuillez entrer un mot de passe différent du précédent.';
        else return null;
    }

    public function verifyToken(string $reset_token): ?string {
        if ($reset_token == null) return 'Il n\'existe aucun token.';
        $timezoneParis = new \DateTimeZone('Europe/Paris');
        $time_now = new \DateTimeImmutable('now',$timezoneParis );
        $stmt = $this->pdo->prepare('SELECT reset_token_expiry FROM users WHERE reset_token = :reset_token');
        $stmt->execute(['reset_token' => $reset_token]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $expiry_date = new \DateTimeImmutable($result['reset_token_expiry'], $timezoneParis);
        if ($time_now > $expiry_date) {
            return 'Cette demande n\'est plus valide.';
        }
        else return null;
    }
}
