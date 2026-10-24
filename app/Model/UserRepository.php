<?php
namespace App\Model;
use Nette\Utils\DateTime;
use Core\Db;
final class UserRepository {
    public \PDO $pdo;
    public function __construct(?\PDO $pdo = null) {
        $this->pdo =$pdo ?? Db::getPdo();
    }


    public function findByEmail(string $email): ?Teacher{
        $stmt = $this->pdo->prepare('SELECT id,teacher_name,surname,mail,hached_password,high_school_id FROM Teacher WHERE mail = :email');
        $stmt->execute(['email' => $email]);
        $teacher = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$teacher){return null;}
        else{return new Teacher($teacher['id'], $teacher['teacher_name'], $teacher['surname'],$teacher['mail'],$teacher['hached_password'],$teacher['high_school_id']);}
    }

    public function emailExists(string $email): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM Teacher WHERE mail = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ? true : false;
    }

    public function createTeacher(string $teachername, string $surname,string $email, string $password, int $highschoolid): Teacher {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO Teacher (teacher_name,surname,mail,hached_password,high_school_id) VALUES (:teacher_name, :surname, :mail, :hached_password, :high_school_id)');
        $stmt->execute(['teacher_name' => $teachername,'surname' => $surname,'mail'=> $email,'hached_password' => $hashed_password,'high_school_id' => $highschoolid]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Teacher($id, $teachername, $surname, $email, $hashed_password, $highschoolid);
    }

    public function deleteTeacher(string $email, string $password): Teacher {
        $teacher = $this->findByEmail($email);
        if ($teacher === null) {
            throw new \InvalidArgumentException('Aucun utilisateur trouvé pour cet email.');
        }

        if (!$teacher->verifyPassword($password)) {
            throw new \InvalidArgumentException('Le mot de passe est incorrect.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM Teacher WHERE email = :email');
        $stmt->execute(['email' => $email]);

        return $teacher;
    }

    public function updateTeacher(string $reset_token, string $password): Teacher {
        $teacher = $this->findByToken($reset_token);
        if ($teacher === null) {
            throw new \InvalidArgumentException('Aucun utilisateur trouvé pour ce token.');
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('UPDATE Teacher SET hached_password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :reset_token');
        $stmt->execute(['password' => $hashed_password,'reset_token' => $reset_token]);
        $id = $teacher->getId();
        $teachername = $teacher->getTeacherName();
        $surname = $teacher->getSurname();
        $email = $teacher->getEmail();
        $highschoolid = $teacher->getHighSchoolId();
        return new Teacher ($id, $teachername, $surname, $email, $password, $highschoolid);
    }

    public function setResetToken(string $email,string $reset_token,string $expiry): bool {
        $stmt = $this->pdo->prepare('UPDATE Teacher SET reset_token = :token, reset_token_expiry = :expiry WHERE email = :email');
        return $stmt->execute(['token' => $reset_token, 'expiry' => $expiry,'email' => $email]);
    }

    public function findByToken(string $reset_token): ?Teacher {
        $stmt = $this->pdo->prepare('SELECT * FROM Teacher WHERE reset_token = :token');
        $stmt->execute(['token' => $reset_token]);
        $teacher = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$teacher) return null;
        else return new Teacher($teacher['id'], $teacher['teacher_name'], $teacher['surname'],$teacher['mail'],$teacher['hached_password'],$teacher['high_school_id']);
    }

    public function verifyPasswordUsability(string $reset_token,string $password): ?string {
        $stmt = $this->pdo->prepare('SELECT password FROM Teacher WHERE reset_token = :reset_token');
        $stmt->execute(['reset_token' => $reset_token]);
        $teacher = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (password_verify($password, $teacher['password']))
            return 'Veuillez entrer un mot de passe différent du précédent.';
        else return null;
    }

    public function verifyToken(string $reset_token): ?string {
        if ($reset_token == null) return 'Il n\'existe aucun token.';
        $time_now = new \DateTimeImmutable();
        $stmt = $this->pdo->prepare('SELECT reset_token_expiry FROM Teacher WHERE reset_token = :reset_token');
        $stmt->execute(['reset_token' => $reset_token]);
        $expiry_date = $stmt->fetch(\PDO::FETCH_ASSOC)['reset_token_expiry'];
        if ($time_now > $expiry_date) {
            return 'Cette demande n\'est plus valide.';
        }
        else return null;
    }

    public function takeHighSchool()
    {
        $stmt = $this->pdo->prepare('SELECT id, high_school_name FROM High_school ');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByPath(string $path): ?Classes{
        $stmt = $this->pdo->prepare('SELECT id ,teacher_id ,subject_id ,title ,path_name FROM Class WHERE path_name = :path_name ');
        $stmt->execute(['path_name' => $path]);
        $classes = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$classes){return null;}
        else{return new Classes($classes['id'] ,$classes['teacher_id'] ,$classes['subject_id'] ,$classes['title'] ,$classes['path_name']);}
    }

    public function pathExists(string $pathname, int $teacherid): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM Class WHERE path_name = :path_name AND teacher_id = :teacher_id');
        $stmt->execute(['path_name' => $pathname,'teacher_id' => $teacherid]);
        return $stmt->fetch() ? true : false;
    }

    public function createClass(string $teacherid, int $subjectid,string $title, string $pathname): Classes {
        $stmt = $this->pdo->prepare('INSERT INTO Class (teacher_id ,subject_id ,title ,path_name) VALUES (:teacher_id ,:subject_id ,:title ,:path_name)');
        $stmt->execute(['teacher_id' => $teacherid,'subject_id' => $subjectid,'title'=> $title,'path_name' => $pathname]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Classes($id, $teacherid, $subjectid, $title, $pathname);
    }

    public function deleteClass(string $pathname, int $teacherid): Classes {
        $class = $this->findByPath($pathname);
        if ($class === null) {
            throw new \InvalidArgumentException('Aucun cour trouvé.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM Class WHERE path_name = :path_name AND teacher_id = :teacherid');
        $stmt->execute(['path_name' => $pathname,'teacher_id' => $teacherid]);

        return $class;
    }

    public function takeSubject()
    {
        $stmt = $this->pdo->prepare('SELECT id ,subject_name FROM Subjec ');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
