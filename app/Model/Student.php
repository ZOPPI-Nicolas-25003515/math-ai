<?php

namespace App\Model;

class Student
{
    public function __construct(
        public readonly int    $id,
        public readonly int $student_id,
        public readonly int $high_school_id,
        public readonly int $title_id,
        public readonly int $rank_id,
        public readonly int $education_id,
        public readonly int $speciality_id
    )
    {
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getStudentId(): int{
        return $this->student_id;
    }

    public function getHighSchoolId(): int{
        return $this->high_school_id;
    }

    public function getTitleId(): int{
        return $this->title_id;
    }

    public function getRankId(): int{
        return $this->rank_id;
    }

    public function getEducationId(): int{
        return $this->education_id;
    }

    public function getSpecialityId(): int{
        return $this->speciality_id;
    }
}