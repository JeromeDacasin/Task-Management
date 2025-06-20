<?php

namespace App\Services;

use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskService
{
    public function __construct(protected TaskRepositoryInterface $repository)
    {
     
    }

    public function index(array $filters) 
    {
        $userId = Auth::id(); 

        $cacheKey = 'tasks_all_' . $userId . '_' . md5(json_encode($filters));

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($filters, $userId) {
            return $this->repository->index($filters, $userId);
        }); 
    }

    public function create(array $request)
    {
        $userId = Auth::user()->id;

        Cache::forget('tasks_all_' . $userId);
        
        $request['user_id'] = $userId;
        
        $user = $this->repository->create($request);
        
        return $user;
    }

    public function show(int $id) 
    {
        return $this->repository->show($id);
    }

    public function update(int $id, array $request)
    {
        $userId = Auth::id();
        Cache::forget('tasks_all_' . $userId);

        return $this->repository->update($id, $request);
    }

    public function destroy(int $id)
    {
        $userId = Auth::id();
        Cache::forget('tasks_all_' . $userId);
        return $this->repository->destroy($id);
    }

    public function reOrdering(array $request)
    {
        
    }
}