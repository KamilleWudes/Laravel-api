<?php

namespace App\Repositories;

use App\Models\commentaire;
use App\Repositories\Base\BaseRepository;

class CommentaireRepository extends BaseRepository
{
    protected $comment;
    public function __construct(commentaire $comment)
    {
        parent::__construct($comment);
    }
}
