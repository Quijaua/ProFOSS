<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Github;
use App\Http\Requests\Issue\Create as CreateIssueRequest;
use App\Http\Requests\Issue\Update as UpdateIssueRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Repository;
use Http\Discovery\Exception\NotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

class IssueController extends Controller
{
    public function __construct(private readonly Github $github)
    {
        //
    }

    public function index(): View
    {
        $issues = Issue::query()->paginate(25);

        return view('issues.index', compact('issues'));
    }

    public function create(): View
    {
        return view('issues.create');
    }

    public function store(CreateIssueRequest $request): RedirectResponse
    {
        $url = $request->validated('url');

        try {
            DB::beginTransaction();

            $sanitizedUrl = Github\Issue::sanitizeUrl($url);

            $githubRepository = $this->github->repository(...Arr::except($sanitizedUrl, 'number'));

            $githubIssue = $this->github->issue(...$sanitizedUrl);

            /** @var Repository $repository */
            $repository = Repository::query()->updateOrCreate([
                'name' => $githubRepository->name(),
                'description' => $githubRepository->description(),
                'url' => $githubRepository->url(),
                'owner' => $githubRepository->owner(),
                'full_name' => $githubRepository->fullName(),
            ]);

            $project = Project::query()->updateOrCreate([
                'title' => $githubRepository->fullName(),
                'short_description' => $githubRepository->description(),
                'url' => $githubRepository->url(),
            ]);

            /** @var Issue $issue */
            $issue = Issue::query()->create([
                'title' => $githubIssue->title(),
                'body' => $githubIssue->body(),
                'url' => $githubIssue->url(),
                'state' => $githubIssue->state(),
                'repository_id' => $repository->getKey(),
                'project_id' => $project->getKey(),
            ]);

            DB::commit();
        } catch (InvalidArgumentException|NotFoundException $e) {
            Log::error($e->getMessage(), $e->getTrace());

            DB::rollBack();

            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());

            DB::rollBack();

            return back()->with('error', 'Failed to fetch issue from Github');
        }

        return redirect()->route('issues.show', $issue->id);
    }

    public function show(Issue $issue): View
    {
        return view('issues.show', compact('issue'));
    }

    public function edit(Issue $issue): View
    {
        return view('issues.edit', compact('issue'));
    }

    public function update(UpdateIssueRequest $request, Issue $issue): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $issue->update($validated);
        } catch (Throwable $e) {
            Log::error("Erro ao editar (ID: $issue->id): {$e->getMessage()}");

            return back()
                ->with('status', 'error')
                ->with('message', 'Erro ao editar.');
        }

        return redirect()->route('issues.show', $issue->id);
    }

    public function destroy(Issue $issue): RedirectResponse
    {
        try {
            $issue->delete();
        } catch (Throwable $e) {
            Log::error("Erro ao excluir: {$e->getMessage()}");

            return back()
                ->with('status', 'error')
                ->with('message', 'Erro ao excluir.');
        }

        return redirect()->route('issues.index');
    }
}
