<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatecategorieRequest extends FormRequest
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
            'libelle' => 'nullable', // Ajoutez d'autres règles de validation au besoin
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }

    public function attributes(): array
    {
        return [
            'libelle' => 'nom', // Assurez-vous que cela correspond à l'utilisation réelle dans vos vues ou contrôleurs
        ];
    }
}
