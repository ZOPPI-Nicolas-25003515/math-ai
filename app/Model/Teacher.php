<?php

namespace App\Model;

final class Teacher
{
    public function __construct(
        public readonly int    $id,
        public readonly string $teachername,
        public readonly string $surname,
        public readonly string $mail,
        public readonly string $passwordHash,
        public readonly int $highschoolid,
    )
    {
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->passwordHash);
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getTeacherName(): string
    {
        return $this->teachername;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getHighSchoolId(): int
    {
        return $this->highschoolid;
    }

}