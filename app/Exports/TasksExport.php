<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Task::with(['project', 'assignee'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Project',
            'Assigned To',
            'Status',
            'Due Date',
            'Created At'
        ];
    }

    public function map($task): array
    {
        return [
            $task->id,
            $task->title,
            $task->project->name,
            $task->assignee ? $task->assignee->name : 'Unassigned',
            ucfirst($task->status),
            $task->due_date,
            $task->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
