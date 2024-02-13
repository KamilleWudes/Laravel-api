<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Base\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $user;
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
