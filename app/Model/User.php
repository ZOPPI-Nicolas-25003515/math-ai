<?php
namespace App\Model;
final class User {
public function __construct(
    public readonly int $id,
    public readonly string $username,
    public readonly string $usersurname,
    public readonly string $mail,
    public readonly string $passwordhash,
) {}

    public function verifyPassword(string $password): bool {
    return password_verify($password, $this->passwordhash);
    }

    public function getId(): int {
    return $this->id;
    }

    public function getUsername(): string {
    return $this->username;
    }

    public function getUsersurname(): string {
    return $this->usersurname;
    }

    public function getEmail(): string {
    return $this->mail;
    }


}
