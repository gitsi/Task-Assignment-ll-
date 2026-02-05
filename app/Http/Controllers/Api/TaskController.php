<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $tasks = Task::select(['id', 'title', 'project_id', 'assigned_to', 'status', 'due_date', 'attachment', 'created_at'])
            ->with([
                'project' => fn($q) => $q->select(['id', 'name']),
                'assignee' => fn($q) => $q->select(['id', 'name'])
            ])->get();
        return $this->successResponse(TaskResource::collection($tasks));
    }

    public function getByProject($projectId)
    {
        $tasks = Task::select(['id', 'title', 'project_id', 'assigned_to', 'status', 'due_date', 'attachment', 'created_at'])
            ->where('project_id', $projectId)
            ->with([
                'project' => fn($q) => $q->select(['id', 'name']),
                'assignee' => fn($q) => $q->select(['id', 'name'])
            ])->get();
        return $this->successResponse(TaskResource::collection($tasks));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $task->update(['status' => $request->status]);

        return $this->successResponse(new TaskResource($task), 'Task status updated associated.');
    }
}
