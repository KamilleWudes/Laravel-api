<?php

namespace App\Repositories;

use App\Models\categorie;
use App\Models\Category;
use App\Repositories\Base\BaseRepository;

class CategoryRepository extends BaseRepository
{
    protected $category;
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
