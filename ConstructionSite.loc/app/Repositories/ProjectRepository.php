<?php

namespace App\Repositories;

use App\Models\Project;


class ProjectRepository
{
    public function getUserProjects(int $user_id)
    {
        return Project::where('user_id', $user_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
