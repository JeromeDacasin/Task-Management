<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteOldTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = now()->subDays(30);

        $tasks = Task::where('created_at', '<', $threshold)->get();

        $deletedCount = 0;

        foreach ($tasks as $task) {
            $task->delete();
            Log::channel('taskcleanup')->info("Deleted task ID {$task->id} - created at {$task->created_at}");
            $deletedCount++;
        }

        $this->info("Deleted $deletedCount old tasks.");
    }
}
