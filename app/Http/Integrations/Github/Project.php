<?php

namespace App\Http\Integrations\Github;

use InvalidArgumentException;

final class Project
{
    public const ORGANIZATION_TYPE = 'orgs';
    public const PERSONAL_TYPE = 'users';

    public function __construct(
        private readonly string $title,
        private readonly string $shortDescription,
        private readonly string $url,
    ) {
        //
    }

    public static function make(array $data): self
    {
        return new self(
            $data['title'],
            $data['shortDescription'] ?? '',
            $data['url'],
        );
    }

    public function title(): string
    {
        return $this->title;
    }

    public function shortDescription(): string
    {
        return $this->shortDescription;
    }

    public function url(): string
    {
        return $this->url;
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

