<?php

namespace App\Http\Integrations\Github;

use InvalidArgumentException;

final class Issue
{
    public const STATE_OPEN = 'open';
    public const STATE_CLOSED = 'closed';

    public const STATES = [
        self::STATE_OPEN,
        self::STATE_CLOSED,
    ];

    public function __construct(
        private readonly string $title,
        private readonly string $body,
        private readonly string $url,
        private readonly string $state,
    ) {
        if (!in_array($this->state, self::STATES)) {
            throw new InvalidArgumentException('Invalid state');
        }
    }

    public static function make(array $data): self
    {
        return new self(
            $data['title'],
            $data['body'],
            $data['html_url'],
            $data['state'],
        );
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
