<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelVote\Traits\Voter as OvertrueVoter;

trait Voter
{
    use OvertrueVoter;

    public function hasUpvoted(Model $object): bool
    {
        return ($this->relationLoaded('votes') ? $this->votes : $this->votes())
            ->where('votable_id', $object->getKey())
            ->where('votable_type', $object->getMorphClass())
            ->where('votes', '>=', 0)
            ->exists();
    }

    public function hasDownvoted(Model $object): bool
    {
        return ($this->relationLoaded('votes') ? $this->votes : $this->votes())
            ->where('votable_id', $object->getKey())
            ->where('votable_type', $object->getMorphClass())
            ->where('votes', '<=', 0)
            ->exists();
    }
}
