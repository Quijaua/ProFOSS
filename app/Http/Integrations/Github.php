<?php

namespace App\Http\Integrations;

use App\Http\Integrations\Github\Issue;
use App\Http\Integrations\Github\Project;
use GrahamCampbell\GitHub\GitHubManager;
use Http\Discovery\Exception\NotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
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

    /**
     * @throws Throwable
     */
    public function project(string $type, string $owner, int|string $number): Project
    {
        try {
            $data = match ($type) {
                Project::ORGANIZATION_TYPE => $this->getOrganizationProject($owner, $number),
                Project::PERSONAL_TYPE => $this->getPersonalProject($owner, $number),
                default => throw new InvalidArgumentException('Tipo de projeto não é válido'),
            };
        } catch (Throwable $e) {
            if ($e->getCode() !== 404) {
                throw $e;
            }

            throw new NotFoundException('Projeto não encontrado');
        }

        return Project::make($data);
    }

    /**
     * @throws Throwable
     */
    protected function getOrganizationProject(string $owner, int $number): array
    {
        return $this->getProject('organization', $owner, $number);
    }

    /**
     * @throws Throwable
     */
    protected function getPersonalProject(string $owner, int $number): array
    {
        return $this->getProject('user', $owner, $number);
    }

    /**
     * @throws Throwable
     */
    private function getProject(string $type, string $owner, int $number): array
    {
        $query = <<<QUERY
            query{
                $type(login: "$owner") {
                    projectV2(number: $number)  {
                        title
                        shortDescription
                    }
                }
            }
QUERY;

        try {
            $data = $this->github->api('graphql')->execute($query);
        } catch (Throwable $e) {
            if (Str::contains($e->getMessage(), 'Could not resolve to a ProjectV2 with the number')) {
                throw new NotFoundException(code: 404);
            }

            throw $e;
        }

        return Arr::get($data, "data.$type.projectV2");
    }
}
