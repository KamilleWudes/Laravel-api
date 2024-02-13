<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreusersRequest extends FormRequest
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
            "name" => "required",
            "prenom" => "required",
            'email' => ['required','email','unique:users'],
            'password' => 'required|min:8|max:16',

        ];
    }

    public function messages()
    {
      return [
        'name.required'=>'le champ nom est obligatoire',
        'prenom.required'=>'Le champ prenom est obligatoire',
        'email.required'=>'L\'adresse email est obligatoire',
        'email.email'=>'Veuillez saisir une adresse email valide',
        'email.unique'=>'Cette adresse email est déjà utilisée',
        'password.required'=>'Le mot de passe est obligatoire',
        'password.min'=>'Le mot de passe doit contenir au moins 8 caractères',
        'password.max'=>'Le mot de passe ne peut pas dépasser les  16 caractères',
      ];
    }
}
