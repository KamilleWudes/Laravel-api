<?php

namespace App\Repositories;

use App\Models\categorie;
use App\Repositories\Base\BaseRepository;

class CategoryRepository extends BaseRepository
{
    protected $category;
    public function __construct(categorie $category)
    {
        parent::__construct($category);
    }
}
