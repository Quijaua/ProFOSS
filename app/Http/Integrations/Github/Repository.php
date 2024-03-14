<?php

namespace App\Http\Integrations\Github;

final class Repository
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly string $url,
        private readonly string $owner,
    ) {
        //
    }

    public static function make(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? '',
            url: $data['html_url'],
            owner: $data['owner']['login'],
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function owner(): string
    {
        return $this->owner;
    }

    public function fullName(): string
    {
        return "$this->owner/$this->name";
    }
}

