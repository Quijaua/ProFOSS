<?php

namespace App\Livewire\Issues;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    protected $listeners = [
        'issue.table.reload' => '$refresh'
    ];

    public ?User $creator = null;

    public function render(): View
    {
        $issues = Issue::query()
            ->when($this->creator, function (Builder $query, User $user): Builder {
                return $query->whereHas('createdBy', fn(Builder $query) => $query->where('id', $user->id));
            })
            ->withCount('upvoters')
            ->orderBy('upvoters_count', 'desc')
            ->paginate(25);

        return view('livewire.issue.table', compact('issues'));
    }
}
