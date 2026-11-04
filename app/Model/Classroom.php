<?php

namespace App\Model;

class Classroom
{
    public function __construct(
        public readonly int    $id,
        public readonly int $teacherid,
        public readonly string $name
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTaecherId(): int
    {
        return $this->teacherid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}