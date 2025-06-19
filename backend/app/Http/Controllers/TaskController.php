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

    public function index(Request $request)
    {
        return $this->service->index($request->all());
    }

    public function store(TaskRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id) 
    {
        return $this->service->show($id);
    }

    public function update($id, TaskRequest $request)
    {
        return $this->service->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function reOrdering(Request $request)
    {
        return $this->service->reOrdering($request->all());
    }
}
