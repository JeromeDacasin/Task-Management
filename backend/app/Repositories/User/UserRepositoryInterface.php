<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getUsers(int $perPage = 10);
}