<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $service)
    {
        
    }

    public function create(TaskRequest $request)
    {
        return $this->service->create($request->all());
    }
}
