<?php 

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(protected Task $task) {}

    public function index(array $filters)
    {
        $query = $this->task::query();

        if (isset($filters['status'])) {
            $query->status($filters['status']);
        }

        if (isset($filters['priority'])) {
            $query->priority($filters['priority']);
        }

        return $query->paginate(10);
    }

    public function create(array $request)
    {
        return $this->task->create($request);
    }

    public function show(int $id)
    {
        return $this->getById($id);
    }

    public function update(int $id, array $request)
    {
        $task = $this->getById($id);
        $task->update($request);
        return $task;
    }

    public function destroy(int $id)
    {
        $task = $this->getById($id);
        $task->delete();
    }

    private function getById($id)
    {
        $task = $this->task::find($id);

        if (!$task) {
            throw new ModelNotFoundException('No Task Found', 404);
        }

        return $task;
    }
}