<?php

namespace App\Http\Integrations;

use App\Http\Integrations\Github\Issue;
use GrahamCampbell\GitHub\GitHubManager;

final class Github
{
    public function __construct(private readonly GitHubManager $github)
    {
        //
    }

    public function issue(string $owner, string $repository, int|string $id): Issue
    {
        $issue = $this->github->issues()->show($owner, $repository, $id);

        return new Issue($issue['title'], $issue['body'], $issue['html_url']);
    }
}
