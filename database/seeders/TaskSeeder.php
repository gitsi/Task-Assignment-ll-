<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = \App\Models\Project::all();
        $users = \App\Models\User::all();

        if ($projects->count() == 0 || $users->count() == 0) {
            return;
        }

        foreach ($projects as $project) {
             for ($i = 0; $i < 3; $i++) {
                 \App\Models\Task::create([
                     'project_id' => $project->id,
                     'title' => 'Task ' . $i . ' for ' . $project->name,
                     'description' => 'Task description...',
                     'assigned_to' => $users->random()->id,
                     'status' => 'pending',
                     'due_date' => now()->addDays(rand(1, 10)),
                 ]);
             }
        }
    }
}
