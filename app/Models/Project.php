<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected static function booted()
    {
        static::deleting(function ($project) {
            // Trigger individual task deletes to clean up files
            foreach ($project->tasks as $task) {
                $task->delete();
            }
        });
    }

    protected $fillable = ['name', 'description', 'start_date', 'end_date'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
