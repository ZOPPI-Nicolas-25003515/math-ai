<?php

namespace App\Model;

use DateTimeImmutable;

final class Teacher
{
    public function __construct(
        public readonly int    $id,
        public readonly int $teacherid,
        public readonly int $highschollid,
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
   public function getTeacherid(): int{
        return $this->teacherid;
   }

   public function getHighscollid(): int{
        return $this->highschollid;
   }

}