<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Base\BaseRepository;

class ArticleRepository extends BaseRepository
{
    protected $article;
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }

}
