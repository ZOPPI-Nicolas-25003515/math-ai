<?php
namespace App\Model;
use Nette\Utils\DateTime;
use Core\Database;
final class UserRepository {
    public \PDO $pdo;
    public function __construct(?\PDO $pdo = null) {
        $this->pdo =$pdo ?? Database::getPdo();
    }


    public function findByEmail(string $email): ?Teacher{
        $stmt = $this->pdo->prepare('SELECT id ,user_name ,user_surname ,mail ,hached_password FROM Users WHERE mail = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$user) {
            return null;
        } else {
            return new User($user['id'], $user['user_name'], $user['user_surname'], $user['mail'], $user['hached_password']);
        }
    }
    public function emailExists(string $email): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM Users WHERE mail = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ? true : false;
    }

    public function createUser(string $username, string $usersurname,string $email, string $password): ?User {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO Users (user_name ,user_surname ,mail ,hached_password ) VALUES (:user_name ,:user_surname ,:mail ,:hached_password)');
        $stmt->execute(['user_name' => $username,'user_surname' => $usersurname,'mail'=> $email,'hached_password' => $hashed_password ]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new User($id, $username, $usersurname, $email, $hashed_password);
    }

    public function deleteUser(string $email, string $password): User {
        $user = $this->findByEmail($email);
        if ($user === null) {
            throw new \InvalidArgumentException('Aucun utilisateur trouvé pour cet email.');
        }

        if (!$user->verifyPassword($password)) {
            throw new \InvalidArgumentException('Le mot de passe est incorrect.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM Users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        return $user;
    }

    public function updateUser(string $reset_token, string $password): User {
        $user = $this->findByToken($reset_token);
        if ($user === null) {
            throw new \InvalidArgumentException('Aucun utilisateur trouvé pour ce token.');
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('UPDATE Users SET hached_password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :reset_token');
        $stmt->execute(['password' => $hashed_password,'reset_token' => $reset_token]);
        $id = $user->getId();
        $username = $user->getUsername();
        $usersurname = $user->getUsersurname();
        $email = $user->getEmail();
        return new Teacher ($id, $username, $usersurname, $email, $password);
    }

    public function setResetToken(string $email,string $reset_token,string $expiry): bool {
        $stmt = $this->pdo->prepare('UPDATE Users SET reset_token = :token, reset_token_expiry = :expiry WHERE mail = :email');
        return $stmt->execute(['token' => $reset_token, 'expiry' => $expiry,'mail' => $email]);
    }

    public function findByToken(string $reset_token): ?User {
        $stmt = $this->pdo->prepare('SELECT * FROM Users WHERE reset_token = :token');
        $stmt->execute(['token' => $reset_token]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$user) return null;
        else return new User($user['id'], $user['user_name'], $user['user_surname'], $user['mail'],$user['hached_password']);
    }

    public function verifyPasswordUsability(string $reset_token,string $password): ?string {
        $stmt = $this->pdo->prepare('SELECT hached_password FROM Users WHERE reset_token = :reset_token');
        $stmt->execute(['reset_token' => $reset_token]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (password_verify($password, $user['hached_password']))
            return 'Veuillez entrer un mot de passe différent du précédent.';
        else return null;
    }

    public function verifyToken(string $reset_token): ?string {
        if ($reset_token == null) return 'Il n\'existe aucun token.';
        $timezoneParis = new \DateTimeZone('Europe/Paris');
        $time_now = new \DateTimeImmutable('now',$timezoneParis );
        $stmt = $this->pdo->prepare('SELECT reset_token_expiry FROM Users WHERE reset_token = :reset_token');
        $stmt->execute(['reset_token' => $reset_token]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $expiry_date = new \DateTimeImmutable($result['reset_token_expiry'], $timezoneParis);
        if ($time_now > $expiry_date) {
            return 'Cette demande n\'est plus valide.';
        }
        else return null;
    }

    public function createTeacher(int $teacherid, int $highschoolid): Teacher
    {
        $stmt = $this->pdo->prepare('INSERT INTO Teacher (teacher_id ,high_school_id) VALUES (:teacher_id ,:high_school_id)');
        $stmt->execute(['teacher_id' => $teacherid, 'high_school_id' => $highschoolid]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Teacher($id, $teacherid, $highschoolid);
    }

    public function createNotAffiliated(int $notaffiliatedid, int $titleid = 1): NotAffiliated
    {
        $stmt = $this->pdo->prepare('INSERT INTO Not_affiliated (not_affiliated_id ,title_id) VALUES (:not_affiliated_id, :title_id )');
        $stmt->execute(['not_affiliated_id' => $notaffiliatedid, 'title_id' => $titleid]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new NotAffiliated($id, $notaffiliatedid , $titleid);
    }

    public function createClassroom(int $teacherid, string $name): Classroom
    {
        $stmt = $this->pdo->prepare('INSERT INTO Classroom (teacher_id ,name_classroom) VALUES (:teacher_id, :name_classroom )');
        $stmt->execute(['teacher_id' => $teacherid, 'name_classroom' => $name]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Classroom($id, $teacherid , $name);
    }

    public function createParticipantClassroom(int $classroomid, int $studentid ): ParticipantClassroom
    {
        $stmt = $this->pdo->prepare('INSERT INTO Classroom (classroom_id ,student_id) VALUES (:classroom_id, :student_id )');
        $stmt->execute(['classroom_id' => $classroomid, 'student_id' => $studentid]);
        return new ParticipantClassroom($classroomid, $studentid);
    }

    public function createStudent(int $student_id,int $high_school_id,int $title_id = 1,int $rank_id,int $education_id,int $speciality_id)
    {
        $stmt = $this->pdo->prepare('INSERT INTO Classroom ( 	student_id ,high_school_id ,title_id ,rank_id ,education_id ,speciality_id) VALUES (:student_id, :high_school_id, :title_id, :rank_id, :education_id, :speciality_id )');
        $stmt->execute(['student_id' => $student_id, 'high_school_id' => $high_school_id, 'title_id' => $title_id, 'rank_id' => $rank_id, 'education_id' => $education_id, 'speciality_id' => $speciality_id]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Student($id, $student_id , $high_school_id ,$title_id ,$rank_id, $education_id ,$speciality_id);
    }

    public function classTitleTeacher(int $teacherid, int $subject)
    {
        $stmt = $this->pdo->prepare('SELECT id,title FROM Class WHERE teacher_id = :teacher_id AND subject_id = :subject_id');
        $stmt->execute(['teacher_id' => $teacherid,'subject_id' => $subject]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findClassById(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT id,title,path_name FROM Class WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function findExerciseByPath(string $path): ?Exercise{
        $stmt = $this->pdo->prepare('SELECT id ,teacher_id ,subject_id ,exercise_path ,type_name ,difficulty_name FROM Exercise WHERE  exercise_path = :exercise_text ');
        $stmt->execute(['exercise_path' => $path]);
        $exercise = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$exercise){return null;}
        else{return new Exercise($exercise['id'] ,$exercise['teacher_id'] ,$exercise['subject_id'] ,$exercise['exercise_path'] ,$exercise['type_name'] ,$exercise['difficulty_name']);}
    }

    public function pathExerciseExists(string $pathname, int $teacherid): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM Exercise WHERE exercise_path = :exercise_path AND teacher_id = :teacher_id');
        $stmt->execute(['exercise_path' => $pathname,'teacher_id' => $teacherid]);
        return $stmt->fetch() ? true : false;
    }

    public function findIdExercise(string $pathname, int $teacherid)
    {
        $stmt = $this->pdo->prepare('SELECT id FROM Exercise WHERE exercise_path = :exercise_path AND teacher_id = :teacher_id');
        $stmt->execute(['exercise_path' => $pathname,'teacher_id' => $teacherid]);
        $exercise = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$exercise){return null;}
        else{return new Exercise($exercise['id']);}
    }

    public function createExercise(int $teacherid, int $subjectid, string $pathname, string $type, string $difficulty): Exercise {
        $stmt = $this->pdo->prepare('INSERT INTO Exercise (teacher_id ,subject_id ,exercise_path ,type_name ,difficulty_name) VALUES (:teacher_id ,:subject_id ,:exercise_path ,:type_name, :difficulty_name)');
        $stmt->execute(['teacher_id' => $teacherid,'subject_id' => $subjectid,'exercise_path'=> $pathname,'type_name' => $type,'difficulty_name' => $difficulty]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Exercise($id, $teacherid, $subjectid, $pathname, $type, $difficulty);
    }

    public function deleteExercise(string $pathname, int $teacherid): Exercise {
        $class = $this->findByPath($pathname);
        if ($class === null) {
            throw new \InvalidArgumentException('Aucun cour trouvé.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM Exercise WHERE path_name = :path_name AND teacher_id = :teacherid');
        $stmt->execute(['path_name' => $pathname,'teacher_id' => $teacherid]);

        return $class;
    }

    public function takeHighSchool()
    {
        $stmt = $this->pdo->prepare('SELECT id, high_school_name FROM High_school ');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function takeRank()
    {
        $stmt = $this->pdo->prepare('SELECT  id ,rank_name FROM Rank ');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function takeEducation()
    {
        $stmt = $this->pdo->prepare('SELECT  id ,education_name FROM Education ');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function takeSpeciality()
    {
        $stmt = $this->pdo->prepare('SELECT  id ,speciality_name FROM Speciality ');
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

    public function classTitleTeacher(int $teacherid, int $subject)
    {
        $stmt = $this->pdo->prepare('SELECT id,title FROM Class WHERE teacher_id = :teacher_id AND subject_id = :subject_id');
        $stmt->execute(['teacher_id' => $teacherid,'subject_id' => $subject]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
        public function findClassById(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT id,title,path_name FROM Class WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findExerciseByPath(string $path): ?Exercise{
        $stmt = $this->pdo->prepare('SELECT id ,teacher_id ,subject_id ,exercise_path ,type_name ,difficulty_name FROM Exercise WHERE  exercise_path = :exercise_text ');
        $stmt->execute(['exercise_path' => $path]);
        $exercise = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$exercise){return null;}
        else{return new Exercise($exercise['id'] ,$exercise['teacher_id'] ,$exercise['subject_id'] ,$exercise['exercise_path'] ,$exercise['type_name'] ,$exercise['difficulty_name']);}
    }

    public function pathExerciseExists(string $pathname, int $teacherid): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM Exercise WHERE exercise_path = :exercise_path AND teacher_id = :teacher_id');
        $stmt->execute(['exercise_path' => $pathname,'teacher_id' => $teacherid]);
        return $stmt->fetch() ? true : false;
    }

    public function createExercise(int $teacherid, int $subjectid, string $pathname, string $type, string $difficulty,): Exercise {
        $stmt = $this->pdo->prepare('INSERT INTO Exercise (teacher_id ,subject_id ,exercise_path ,type_name ,difficulty_name) VALUES (:teacher_id ,:subject_id ,:exercise_path ,:type_name, :difficulty_name)');
        $stmt->execute(['teacher_id' => $teacherid,'subject_id' => $subjectid,'exercise_path'=> $pathname,'type_name' => $type,'difficulty_name' => $difficulty]);
        $id = $this->pdo->lastInsertId();
        $id = (int) $id;
        return new Exercise($id, $teacherid, $subjectid, $pathname, $type, $difficulty);
    }

    public function deleteExercise(string $pathname, int $teacherid): Exercise {
        $class = $this->findByPath($pathname);
        if ($class === null) {
            throw new \InvalidArgumentException('Aucun cour trouvé.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM Exercise WHERE path_name = :path_name AND teacher_id = :teacherid');
        $stmt->execute(['path_name' => $pathname,'teacher_id' => $teacherid]);

        return $class;
    }
}
