<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Github;
use App\Http\Requests\Issue\Create as CreateIssueRequest;
use App\Models\Issue;
use Http\Discovery\Exception\NotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            $sanitizedUrl = Github\Issue::sanitizeUrl($url);

            $githubIssue = $this->github->issue(...$sanitizedUrl);

            $issue = Issue::query()->create([
                'title' => $githubIssue->title(),
                'body' => $githubIssue->body(),
                'url' => $githubIssue->url(),
                'state' => $githubIssue->state(),
            ]);
        } catch (InvalidArgumentException|NotFoundException $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return back()->with('error', 'Failed to fetch issue from Github');
        }

        return redirect()->route('issues.show', $issue->id);
    }

    public function show(Issue $issue): View
    {
        return view('issues.show', compact('issue'));
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
