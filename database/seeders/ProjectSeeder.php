<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            \App\Models\Project::create([
                'name' => 'Project ' . ($i + 1),
                'description' => 'Description for Project ' . ($i + 1),
                'start_date' => now(),
                'end_date' => now()->addDays(30),
            ]);
        }
    }
}
