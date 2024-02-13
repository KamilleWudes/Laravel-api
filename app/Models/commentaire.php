<?php

namespace App\Models;

use App\Models\article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class commentaire extends Model
{
    use HasFactory;
    protected $fillable = [
      'pseudo',
      'commentaire',
      'article_id'
    ];

    Public function articles(){
        return $this->belongsTo(article::class,"article_id","id");
      }
}
