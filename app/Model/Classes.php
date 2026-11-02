<?php

namespace App\Model;

final class Classes
{

    public function __construct(
        public readonly int    $id,
        public readonly int $teacherid,
        public readonly int $subjectid,
        public readonly string $title,
        public readonly string $path
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

    public function getSubjectId(): int
    {
        return $this->subjectid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}