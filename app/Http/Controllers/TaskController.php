<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\TasksExport, 'tasks.xlsx');
    }

    public function exportCsv()
    {
        \App\Jobs\ExportCsvJob::dispatch(auth()->id());
        return redirect()->back()->with('success', 'CSV Export started in background. Check displayed list for status.');
    }

    public function downloadExport(\App\Models\Export $export)
    {
        if ($export->user_id !== auth()->id()) {
            abort(403);
        }
        
        $path = storage_path('app/public/' . $export->file_name);
        
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->download($path);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::select(['id', 'title', 'project_id', 'assigned_to', 'status', 'due_date', 'attachment', 'created_at'])
            ->with([
                'project' => fn($q) => $q->select(['id', 'name']),
                'assignee' => fn($q) => $q->select(['id', 'name'])
            ]);

        if ($request->has('project_id') && $request->project_id != '') {
            $query->where('project_id', $request->project_id);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('assigned_to') && $request->assigned_to != '') {
            $query->where('assigned_to', $request->assigned_to);
        }

        $tasks = $query->latest()->paginate(10);
        $projects = \App\Models\Project::select(['id', 'name'])->get();
        $users = \App\Models\User::select(['id', 'name'])->get(); // For filters
        $exports = \App\Models\Export::select(['id', 'user_id', 'file_name', 'status', 'created_at'])
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        $exports = $exports ? collect([$exports]) : collect();

        if ($request->ajax()) {
            return view('tasks.partials.table', compact('tasks'))->render();
        }

        return view('tasks.index', compact('tasks', 'projects', 'users', 'exports'));
    }

    public function create()
    {
        $projects = \App\Models\Project::select(['id', 'name'])->get();
        $users = \App\Models\User::select(['id', 'name'])->get();
        return view('tasks.create', compact('projects', 'users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/attachments', $filename);
            $data['attachment'] = $filename;
        }

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $projects = \App\Models\Project::select(['id', 'name'])->get();
        $users = \App\Models\User::select(['id', 'name'])->get();
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            // Delete old file if exists
            if ($task->attachment && \Storage::exists('public/attachments/' . $task->attachment)) {
                \Storage::delete('public/attachments/' . $task->attachment);
            }

            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/attachments', $filename);
            $data['attachment'] = $filename;
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
