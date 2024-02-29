<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'min:3', 'max:150', 'regex:/^[A-Za-z]+$/'],
            'lastname' => ['required', 'string', 'min:3', 'max:150', 'regex:/^[A-Za-z]+$/'],
            'username' => ['required', 'string', 'min:3', 'max:25', 'unique:users', 'regex:/^[a-zA-Z][a-zA-Z0-9_-]{2,23}$/'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users', 'regex:/(.+)@(.+)\.(.+)/i'],
            'password' => ['required', 'string', 'min:8', 'max:24', 'confirmed', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', 'not_regex:/\s/'],
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le :attribute est obligatoire.',
            'firstname.string' => 'Le :attribute doit être une chaîne de caractères.',
            'firstname.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
            'firstname.min' => 'Le :attribute doit contenir au minimum :min caractères.',

            'lastname.required' => 'Le :attribute est obligatoire.',
            'lastname.string' => 'Le :attribute doit être une chaîne de caractères.',
            'lastname.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
            'lastname.min' => 'Le :attribute doit contenir au minimum :min caractères.',
            'username.required' => 'Le :attribute est obligatoire.',
            'username.string' => 'Le :attribute doit être une chaîne de caractères.',
            'username.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
            'username.unique' => 'Ce :attribute existe déjà.',
            'username.min' => 'Le :attribute doit contenir au minimum :min caractères.',

            'lastname.regex' => 'Le champ :attribute ne doit contenir que des lettres de A à Z (majuscules ou minuscules).',
            'firstname.regex' => 'Le champ :attribute ne doit contenir que des lettres de A à Z (majuscules ou minuscules).',
            'username.regex' => 'Le champ :attribute doit avoir entre 3 et 24 caractères, commencer par une lettre, et ne peut contenir que des lettres, des chiffres ou des underscores.',
            'password.regex' => 'Le champ :attribute doit inclure au moins une lettre majuscule, une lettre minuscule, un chiffre, et un des caractères spéciaux suivants : @, $, !, %, *, ?, &.',
            'password.not_regex' => 'Le champ :attribute ne doit pas contenir d\'espace vide.',

            'email.required' => 'L\':attribute est obligatoire.',
            'email.string' => 'L\':attribute doit être une chaîne de caractères.',
            'email.email' => 'L\':attribute n\'est pas valide.',
            'email.regex' => 'L\':attribute n\'est pas de format E-mail.',
            'email.max' => 'L\':attribute ne doit pas dépasser :max caractères.',
            'email.unique' => 'Cette :attribute existe déjà.',

            'password.required' => 'Le :attribute est obligatoire.',
            'password.confirmed' => 'Le :attribute n\'est pas conforme.',
            'password.string' => 'Le :attribute doit être une chaîne de caractères.',
            'password.min' => 'Le :attribute doit contenir au moins :min caractères.',
            'password.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
        ];
    }

    public function attributes()
    {
        return [
            'firstname' => 'prénom',
            'lastname' => 'nom de famille',
            'username' => 'nom d\'utilisateur',
            'email' => 'adresse e-mail',
            'password' => 'mot de passe',
        ];
    }
}
