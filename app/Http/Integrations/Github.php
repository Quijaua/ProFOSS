<?php

namespace App\Http\Integrations;

use App\Http\Integrations\Github\Issue;
use GrahamCampbell\GitHub\GitHubManager;
use Http\Discovery\Exception\NotFoundException;
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
    public function issue(string $owner, string $repository, int|string $number): Issue
    {
        try {
            $issue = $this->github->issues()->show($owner, $repository, $number);

            return Issue::make($issue);
        } catch (Throwable $e) {
            if ($e->getCode() !== 404) {
                throw $e;
            }

            throw new NotFoundException('Issue não encontrada');
        }
    }
}
