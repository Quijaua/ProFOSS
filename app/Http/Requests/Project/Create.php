<?php

namespace App\Http\Requests\Project;

use App\Http\Integrations\Github\Validator;
use App\Models\Project;
use App\Rules\ProjectUrl;
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
                Rule::unique(Project::class, 'url'),
                new ProjectUrl(new Validator()),
            ],
        ];
    }
}
