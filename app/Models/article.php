<?php

namespace App\Models;

use App\Models\User;
use App\Models\categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class article extends Model
{
    use HasFactory;
    protected $fillable = [
      'titre',
      'contenu',
      'content',
      'categorie_id',
      'imageName',
    ];

    Public function categories(){
        return $this->belongsTo(categorie::class,"categorie_id","id");
      }
}
