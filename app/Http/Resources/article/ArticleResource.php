<?php

namespace App\Http\Resources\article;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'contenu' => $this->contenu,
            'category_name' => $this->category->libelle,
            'category_id' => $this->category->id,
            'content' => $this->content,
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
            'created_at' => $this->created_at->format('d-m-Y H:i:s')
        ];
    }
}
