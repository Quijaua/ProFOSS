<?php

namespace App\Http\Integrations\Github;

final class Validator
{
    public function issue(string $url): bool
    {
        return preg_match('/https:\/\/github.com\/[a-zA-Z0-9-]+\/[a-zA-Z0-9-]+\/issues\/[0-9]+/', $url) === 1;
    }

    public function project(string $url): bool
    {
        return preg_match('/https:\/\/github.com\/[a-zA-Z0-9-]+\/[a-zA-Z0-9-]+\/projects\/[0-9]+/', $url) === 1;
    }
}
