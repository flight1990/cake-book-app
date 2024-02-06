<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository implements UserInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
