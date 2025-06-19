<?php

namespace App\Services;

use App\Repositories\Task\TaskRepository;

class TaskService
{
    public function __construct(protected TaskRepository $repository)
    {
     
    }

    public function create(array $request)
    {
        $user = $this->repository->create($request);
        return $user;
    }
}