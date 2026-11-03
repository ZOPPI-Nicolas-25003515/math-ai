<?php

namespace App\Model;

class NotAffiliated
{
    public function __construct(
        public readonly int    $id,
        public readonly int $not_affiliated_id,
        public readonly int $title_id
    )
    {
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getNotAffiliatedId(): int{
        return $this->not_affiliated_id;
    }

    public function getTitleId(): int{
        return $this->title_id;
    }

}