<?php

namespace App\Model;
final class Exercise
{
    public function __construct(
        public readonly int    $id,
        public readonly int $sujetid,
        public readonly string $enonce,
        public readonly string $genre,
        public readonly string $dificulte,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

}
