<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $user)
    {
        
    }

    public function getUsers(int $perPage = 10)
    {
        return $this->user::with('tasks')
            ->paginate(10);
    }
}