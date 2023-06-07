<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\ITaskRepository;

class TaskRepository extends BaseRepository implements ITaskRepository
{
    public function __construct(Task $model)
    {
        $this->model = $model;
    }
}
