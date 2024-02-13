<?php

namespace App\Repositories;

use App\Models\article;
use App\Repositories\Base\BaseRepository;

class ArticleRepository extends BaseRepository
{
    protected $article;
    public function __construct(article $article)
    {
        parent::__construct($article);
    }
    
}
