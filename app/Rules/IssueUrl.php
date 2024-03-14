<?php

namespace App\Rules;

use App\Http\Integrations\Github\Validator;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IssueUrl implements ValidationRule
{
    public function __construct(private readonly Validator $validator)
    {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->validator->issue($value)) {
            return;
        }

        $fail(__('The :attribute is not a valid issue URL.', ['attribute' => $attribute]));
    }
}
