<?php

namespace App\Livewire\Issues;

use App\Models\Issue;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    protected $listeners = [
        'issue.table.reload' => '$refresh'
    ];

    public function render(): View
    {
        $issues = Issue::query()
            ->withCount('upvoters')
            ->orderBy('upvoters_count', 'desc')
            ->paginate(25);

        return view('livewire.issue.table', compact('issues'));
    }
}
