<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'contenu',
        'content',
        'category_id',
        'imageName',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
