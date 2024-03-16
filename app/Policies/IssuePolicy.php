<?php

namespace App\Policies;

use App\Models\Issue;
use App\Models\User;

class IssuePolicy
{
    public function update(User $user, Issue $issue): bool
    {
        return $issue->createdBy->is($user);
    }

    public function delete(User $user, Issue $issue): bool
    {
        return $issue->createdBy->is($user);
    }
}
