<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = 'tasks_export_' . now()->timestamp . '.csv';
        
        // Create Export Record
        $export = \App\Models\Export::create([
            'user_id' => $this->userId,
            'file_name' => $fileName,
            'status' => 'processing',
        ]);

        try {
            $path = storage_path('app/public/' . $fileName);
            $file = fopen($path, 'w');
            fputcsv($file, ['ID', 'Title', 'Project', 'Assigned To', 'Status', 'Due Date', 'Created At']);

            \App\Models\Task::select(['id', 'title', 'project_id', 'assigned_to', 'status', 'due_date', 'created_at'])
                ->with([
                    'project' => fn($q) => $q->select(['id', 'name']),
                    'assignee' => fn($q) => $q->select(['id', 'name'])
                ])
                ->chunkById(1000, function ($tasks) use ($file) {
                foreach ($tasks as $task) {
                    fputcsv($file, [
                        $task->id,
                        $task->title,
                        $task->project->name,
                        $task->assignee ? $task->assignee->name : 'Unassigned',
                        ucfirst($task->status),
                        $task->due_date,
                        $task->created_at->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($file);

            // Update Status
            $export->update(['status' => 'completed']);
            
        } catch (\Exception $e) {
            $export->update(['status' => 'failed']);
            \Log::error("CSV Export Failed: " . $e->getMessage());
        }
    }
}
