<?php

namespace App\Http\Integrations\Github;

final class Issue
{
    public function __construct(
        private readonly string $title,
        private readonly string $body,
        private readonly string $url,
    ) {
        //
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function url(): string
    {
        return $this->url;
    }
}
