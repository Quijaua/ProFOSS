<?php

namespace App\Livewire\Issues;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Throwable;

class Vote extends Component
{
    protected $listeners = [
        'issue.{issue.id}.voted' => '$refresh'
    ];

    public Issue $issue;

    #[Computed]
    public function hasUpvoted(): string
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->hasUpvoted($this->issue);
    }

    #[Computed]
    public function hasDownvoted(): string
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->hasDownvoted($this->issue);
    }

    public function upvote(): void
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $user->cancelVote($this->issue);
            $user->upvote($this->issue);
        } catch (Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return;
        }

        $this->dispatch('issue.table.reload');
    }

    public function downvote(): void
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $user->cancelVote($this->issue);
            $user->downvote($this->issue);
        } catch (Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return;
        }

        $this->dispatch('issue.table.reload');
    }

    public function render(): View
    {
        return view('livewire.issue.vote');
    }
}
