<?php

namespace App\Http\Requests\Issue;

use App\Http\Integrations\Github\Validator;
use App\Models\Issue;
use App\Rules\IssueUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Create extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'url' => [
                'required',
                'string',
                'url',
                Rule::unique(Issue::class, 'url'),
                new IssueUrl(new Validator()),
            ],
        ];
    }
}
