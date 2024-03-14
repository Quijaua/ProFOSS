<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index(): View
    {
        $issues = Issue::query()->paginate(25);

        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Issue $issue)
    {
        //
    }

    public function edit(Issue $issue)
    {
        //
    }

    public function update(Request $request, Issue $issue)
    {
        //
    }

    public function destroy(Issue $issue)
    {
        //
    }
}
