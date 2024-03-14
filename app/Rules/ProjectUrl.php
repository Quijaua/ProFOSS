<?php

namespace App\Rules;

use App\Http\Integrations\Github\Validator;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProjectUrl implements ValidationRule
{
    public function __construct(private readonly Validator $validator)
    {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->validator->project($value)) {
            return;
        }

        $fail(__('The :attribute is not a valid project URL.', ['attribute' => $attribute]));
    }
}
