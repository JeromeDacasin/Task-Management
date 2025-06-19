<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface
{
    public function index(array $filters);
    public function create(array $request);
    public function show(int $id);
    public function update(int $id, array $request);
    public function destroy(int $id);
}