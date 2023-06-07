<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Task01',
            ], [
                'title' => 'Task02',
            ], [
                'title' => 'Task03',
            ]
        ];

        foreach ($tasks as $task) {
            if (!Task::query()->where('title', $task['title'])->first()) {
                Task::query()->create($task);
            }
        }
    }
}
