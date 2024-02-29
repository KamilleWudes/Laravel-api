<?php

namespace App\Http\Requests\api\users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'firstname' => ['string', 'min:3', 'max:150', 'regex:/^[A-Za-z]+$/'],
            'lastname' => ['string', 'min:3', 'max:150', 'regex:/^[A-Za-z]+$/'],
            'username' => ['string', 'min:3', 'max:25', 'regex:/^[a-zA-Z][a-zA-Z0-9_-]{2,23}$/'],
            'email' => ['string', 'email', 'max:50','regex:/(.+)@(.+)\.(.+)/i'],
            'birthday' => ['nullable','date_format:Y-m-d'],
        ];
    }

    public function messages()
    {
        return [
            'firstname.string' => 'Le :attribute doit être une chaîne de caractères.',
            'firstname.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
            'firstname.min' => 'Le :attribute doit contenir au minimum :min caractères.',

            'lastname.string' => 'Le :attribute doit être une chaîne de caractères.',
            'lastname.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
            'lastname.min' => 'Le :attribute doit contenir au minimum :min caractères.',
            'username.string' => 'Le :attribute doit être une chaîne de caractères.',
            'username.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
            'username.min' => 'Le :attribute doit contenir au minimum :min caractères.',

            'lastname.regex' => 'Le champ :attribute ne doit contenir que des lettres de A à Z (majuscules ou minuscules).',
            'firstname.regex' => 'Le champ :attribute ne doit contenir que des lettres de A à Z (majuscules ou minuscules).',
            'username.regex' => 'Le champ :attribute doit avoir entre 3 et 24 caractères, commencer par une lettre, et ne peut contenir que des lettres, des chiffres ou des underscores.',

            'email.string' => 'L\':attribute doit être une chaîne de caractères.',
            'email.email' => 'L\':attribute n\'est pas valide.',
            'email.regex' => 'L\':attribute n\'est pas de format E-mail.',
            'email.max' => 'L\':attribute ne doit pas dépasser :max caractères.',

            'birthday.date_format' => 'La :attribute doit etre sous le format (31-12-1990)'
        ];
    }

    public function attributes()
    {
        return [
            'firstname' => 'prénom',
            'lastname' => 'nom de famille',
            'username' => 'nom d\'utilisateur',
            'email' => 'adresse e-mail',
            'birthday' => 'date de naissance',
        ];
    }
}
