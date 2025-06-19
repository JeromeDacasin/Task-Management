<?php 

namespace App\Repositories\Task;

use App\Models\Task;

class TaskRepository 
{
    public function __construct(protected Task $task)
    {
        
    }

    public function index(array $filters) 
    {

    }

    public function create($request)
    {
        return $this->task->create($request);
    }
}