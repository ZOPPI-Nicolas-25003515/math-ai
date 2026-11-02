<?php
namespace App\Model;
use Nette\Utils\DateTime;
use Core\Db;

final class ExerciseRepository{

    public \PDO $pdo;
    public function __construct(?\PDO $pdo = null) {
        $this->pdo =$pdo ?? Db::getPdo();
    }

    public function findById(int $id): ?Exercice{
        $stmt = $this->pdo->prepare('SELECT * FROM Exercice WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $exercice = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$exercice){return null;}
        else{return new Exercice($exercice['id'], $exercice['sujet_id'], $exercice['enonce'],$exercice['genre'], $exercice['dificulte']);}
    }

    public function idExists(int $id): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ? true : false;
    }

    public function createExercise(int $sujet,string $enonce,string $genre, string $dificulte): Exercice {
        $stmt = $this->pdo->prepare('INSERT INTO users (sujet_id ,enonce ,genre ,dificulte) VALUES (:sujet_id, :enonce , :genre, :dificulte)');
        $stmt->execute(['sujet_id'=> $sujet,'enonce'=> $enonce,'genre'=> $genre,'dificulte'=> $dificulte]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Exercice($id, $sujet, $enonce, $genre, $dificulte);
    }

    public function deleteExercise(int $id): Exercice {
        $exercice = $this->findById($id);
        if ($exercice === null) {
            throw new \InvalidArgumentException('Aucun exercice trouvée.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM Exercice WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $exercice;
    }

    public function updateExercise(string $reset_token, string $password): User {
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
        $time_now = new \DateTimeImmutable();
        $stmt = $this->pdo->prepare('SELECT reset_token_expiry FROM users WHERE reset_token = :reset_token');
        $stmt->execute(['reset_token' => $reset_token]);
        $expiry_date = $stmt->fetch(\PDO::FETCH_ASSOC)['reset_token_expiry'];
        if ($time_now > $expiry_date) {
            return 'Cette demande n\'est plus valide.';
        }
        else return null;
    }
}