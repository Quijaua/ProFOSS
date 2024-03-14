<?php

namespace App\Http\Integrations\Github;

use InvalidArgumentException;

final class Project
{
    public const ORGANIZATION_TYPE = 'orgs';
    public const PERSONAL_TYPE = 'users';

    public static function make(array $data): self
    {
        return new self();
    }

    public static function sanitizeUrl(string $url): array
    {
        $url = parse_url($url);
        if ($url === false) {
            throw new InvalidArgumentException('Invalid URL');
        }

        return [
            'type'   => explode('/', $url['path'])[1],
            'owner'  => explode('/', $url['path'])[2],
            'number' => explode('/', $url['path'])[4],
        ];
    }
}

