<?php

namespace App\Services;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class AdminDashboardService 
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
        
    }

    public function getUsers()
    {
        return $this->repository->getUsers()
            ->through(function ($user) {
                $user->task_stats = [
                    'total' => $user->tasks->count(),
                    'completed' => $user->tasks->where('status', 'completed')->count(),
                    'pending' => $user->tasks->where('status', 'pending')->count(),
                ];
                return $user;
            });
    }
}