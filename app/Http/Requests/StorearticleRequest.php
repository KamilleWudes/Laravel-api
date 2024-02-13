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
            'contenu'=>['required','min:5'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required',
            'user_id' => 'required'
        ];
       
    }

    public function messages()
    {
        return[
          'title.required' => "Le titre est obligatoire",
          'title.min' => "Le titre doit contenir au moins 3 caractères",
          'contenu.required' => "Le contenu de l'article est obligatoire",
          'contenu.min' => "Le contenu de l'article doit contenir au moins 5 caractères",
          'image.required' => "L'image est obligatoire",
          'image.file' => "Veuillez envoyer un fichier valide (jpg/png/gif)",
          'image.max' => "La taille du fichier image ne peut pas dépasser 1 Mo",
          'categorie_id.required' => "La catégorie est obligatoire" ,
          'user_id.required' => "L'auteur est obligatoire"
       ] ;
   }
}