<?php

namespace App\Model;

class NotAffiliated
{
    public function __construct(
        public readonly int    $id,
        public readonly string $not_affiliated_name,
        public readonly string $surname,
        public readonly string $email,
        public readonly string $passwordHash,
        public readonly int $title_id,
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

    public function getNotAffiliatedName(): string
    {
        return $this->not_affiliated_name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getTitle(): int
    {
        return $this->title_id;
    }

}