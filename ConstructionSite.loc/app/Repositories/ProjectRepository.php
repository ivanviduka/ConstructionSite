<?php

namespace App\Repositories;

use App\Models\Project;


class ProjectRepository
{
    public function getUserProjects(int $userID)
    {
        return Project::where('user_id', $userID)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getProject(int $id)
    {
        return Project::where('id', $id)
            ->first();
    }

    public function getProjectStatus(int $id)
    {
        return Project::select('is_finished')->where('id', $id)
            ->orderBy('created_at', 'asc')
            ->first();
    }
}
