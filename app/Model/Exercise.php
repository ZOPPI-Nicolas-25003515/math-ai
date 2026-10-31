<?php

namespace App\Model;
final class Exercise
{
    public function __construct(
        public readonly int    $id,
        public readonly int $teacherid,
        public readonly int $sujetid,
        public readonly string $path,
        public readonly string $genre,
        public readonly string $difficulty,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTeacherId(): int{
        return $this->teacherid;
    }

    public function getSubjectId(): int{
        return $this->sujetid;
    }

    public function getPath(): int{
        return $this->path;
    }

    public function getGenre(): int{
        return $this->genre;
    }

    public function getDifficulty(): int{
        return $this->difficulty;
    }
}
