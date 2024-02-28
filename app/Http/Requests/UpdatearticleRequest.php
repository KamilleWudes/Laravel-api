<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatearticleRequest extends FormRequest
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
        $rules = [
            'titre' => ['nullable', 'min:3'],
            'contenu' => ['nullable', 'min:5'],
            'content' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable',
        ];
        if ($this->hasFile('content')) {
            $rules['content'] = ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'];
        } else {
            $rules['content'] = ['nullable'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'titre.nullable' => "Le titre est obligatoire",
            'titre.min' => "Le titre doit contenir au moins 3 caractères",
            'contenu.nullable' => "Le contenu de l'article est obligatoire",
            'contenu.min' => "Le contenu de l'article doit contenir au moins 5 caractères",
            'content.nullable' => "L'image est obligatoire",
            'content.file' => "Veuillez envoyer un fichier valide (jpg/png/gif)",
            'content.max' => "La taille du fichier image ne peut pas dépasser 1 Mo",
            'category_id.nullable' => "La catégorie est obligatoire",
        ];
    }

    public function attributes()
    {
        return [
            'content' =>  "image",
            'titre' =>  "titre",
            'contenu' =>  "contenu",
            'category_id' =>  "categorie",

        ];
    }
}
