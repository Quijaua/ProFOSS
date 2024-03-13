<?php

namespace App\Http\Requests\Perfil;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Update extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {

        return [
            'name'    => 'required|string|max:200',
            'email' => [
                'required',
                'email',
                Rule::unique('perfis')->ignore($this->profile->id),
            ],
            'local'   => 'required|string|max:120',
            'phone'   => 'required|string|max:100',
            'website' => 'required|string|max:200',
            'about'   => 'required|string',
        ];
    }
}
