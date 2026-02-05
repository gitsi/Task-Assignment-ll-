<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    
    protected static function booted()
    {
        static::deleting(function ($task) {
            if ($task->attachment && \Storage::exists('public/attachments/' . $task->attachment)) {
                \Storage::delete('public/attachments/' . $task->attachment);
            }
        });
    }

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'assigned_to',
        'status',
        'attachment',
        'due_date'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
