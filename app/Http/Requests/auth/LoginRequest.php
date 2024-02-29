<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => ['required', 'min:8', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'L\':attribute est obligatoire.',
            'email.exists' => 'Veuillez vérifier l\':attribute',
            'password.required' => 'Le :attribute est obligatoire.',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'adresse e-mail',
            'password' => 'mot de passe',
        ];
    }
}
