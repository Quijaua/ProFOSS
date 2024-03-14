<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Github;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private readonly Github $github)
    {
        //
    }

    public function index(): View
    {
        $projects = Project::query()->paginate(25);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}
