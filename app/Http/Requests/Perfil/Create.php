<?php

namespace App\Http\Requests\Perfil;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:200',
            'email'   => 'required|email|unique:perfis,email',
            'local'   => 'required|string|max:120',
            'phone'   => 'required|string|max:100',
            'website' => 'required|url:http,https|string|max:200',
            'about'   => 'required|string',
        ];
    }
}
