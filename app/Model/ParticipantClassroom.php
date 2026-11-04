<?php

namespace App\Model;

class ParticipantClassroom
{
    public function __construct(
        public readonly int    $classroomid,
        public readonly int $studentid
    )
    {
    }

    public function getClassroomId(): int
    {
        return $this->classroomid;
    }

    public function getStudentId(): int
    {
        return $this->studentid;
    }
}