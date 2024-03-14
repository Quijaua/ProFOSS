<?php

namespace App\Http\Integrations;

use App\Http\Integrations\Github\Issue;
use GrahamCampbell\GitHub\GitHubManager;
use Throwable;

final class Github
{
    public function __construct(private readonly GitHubManager $github)
    {
        //
    }

    /**
     * @throws Throwable
     */
    public function issue(string $owner, string $repository, int|string $id): ?Issue
    {
        try {
            $issue = $this->github->issues()->show($owner, $repository, $id);

            return Issue::make($issue);
        } catch (Throwable $e) {
            if ($e->getCode() !== 404) {
                throw $e;
            }

            return null;
        }
    }
}
