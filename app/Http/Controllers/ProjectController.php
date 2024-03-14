<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Github;
use App\Http\Requests\Project\Create as CreateProjectRequest;
use App\Http\Requests\Project\Update as UpdateProjectRequest;
use App\Models\Project;
use Http\Discovery\Exception\NotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

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

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(CreateProjectRequest $request): RedirectResponse
    {
        $url = $request->validated('url');

        try {
            $sanitizedUrl = Github\Project::sanitizeUrl($url);

            $githubProject = $this->github->project(...$sanitizedUrl);

            $project = Project::query()->create([
                'title'             => $githubProject->title(),
                'short_description' => $githubProject->shortDescription(),
                'url'               => $githubProject->url(),
            ]);
        } catch (InvalidArgumentException|NotFoundException $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return back()->with('error', 'Failed to fetch project from Github');
        }

        return redirect()->route('projects.show', $project->id);
    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}
