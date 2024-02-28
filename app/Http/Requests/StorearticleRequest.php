<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorearticleRequest extends FormRequest
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
            'titre' => ['required', 'min:3'],
            'contenu' => ['required', 'min:5'],
            'content' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    public function messages()
    {
        return [
            'titre.required' => "Le titre est obligatoire",
            'titre.min' => "Le titre doit contenir au moins 3 caractères",
            'contenu.required' => "Le contenu de l'article est obligatoire",
            'contenu.min' => "Le contenu de l'article doit contenir au moins 5 caractères",
            'content.required' => "L'image est obligatoire",
            'content.image' => "Envoyer un image",
            'content.mimes' => "Veuillez envoyer un fichier valide (jpg/png/gif)",
            'content.max' => "La taille du fichier image ne peut pas dépasser 1 Mo",
            'category_id.required' => "La catégorie est obligatoire",
            'category_id.exists' => "La catégorie n'existe pas ",
        ];
    }
}
