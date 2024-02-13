<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecategorieRequest extends FormRequest
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
            'libelle' => 'required|unique:categories|max:255', // Ajoutez d'autres règles de validation au besoin
        ];
    }

    public function messages(): array
    {
        return [
            'libelle.required' => 'Le :attribute est obligatoire.',
        ];
    }

    public function attributes(): array
    {
        return [
            'libelle' => 'nom', // Assurez-vous que cela correspond à l'utilisation réelle dans vos vues ou contrôleurs
        ];
    }
}
