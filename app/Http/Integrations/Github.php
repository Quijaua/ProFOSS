<?php

namespace App\Http\Integrations;

use App\Http\Integrations\Github\Issue;
use App\Http\Integrations\Github\Project;
use GrahamCampbell\GitHub\GitHubManager;
use Http\Discovery\Exception\NotFoundException;
use InvalidArgumentException;
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
            $data = $this->github->issues()->show($owner, $repository, $number);
        } catch (Throwable $e) {
            if ($e->getCode() !== 404) {
                throw $e;
            }

            throw new NotFoundException('Issue não encontrada');
        }

        return Issue::make($data);
    }

    public function project(string $type, string $owner, int|string $number): Project
    {
        try {
            $data = match ($type) {
//                Project::ORGANIZATION_TYPE => $data = $this->github->repositories()->projects()->show($owner, $number),
//                Project::PERSONAL_TYPE => $data = $this->github->repositories()->projects()->show($owner, $number),
                default => throw new InvalidArgumentException('Tipo de projeto não é válido'),
            };

//            https://github.com/orgs/taiga-ti/projects/12
//            $issue = $this->github->repositories()->projects()->show($owner, $repository, $number);
//             = [];
        } catch (Throwable $e) {
            if ($e->getCode() !== 404) {
                throw $e;
            }

            throw new NotFoundException('Projeto não encontrado');
        }

        return Project::make($data);
    }
}
