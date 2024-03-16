<?php

namespace App\Observers;

use App\Models\Issue;
use App\Models\User;

class IssueObserver
{
    private ?User $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function creating(Issue $issue): void
    {
        if (!$this->user) {
            return;
        }

        $issue->fill(['created_by' => $this->user->id]);
    }
}
