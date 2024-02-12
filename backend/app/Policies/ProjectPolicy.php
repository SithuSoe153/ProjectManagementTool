<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create_Project(User $user): bool
    {
        return ($user->hasRole(['Admin']) && $user->hasPermission('create_Task'));
    }

    public function update_Project(User $user): bool
    {
        return $user->hasRole(['Admin']) && $user->hasPermission('delete_Task');
    }

    public function delete_Project(User $user): bool
    {
        return $user->hasRole(['Admin']) && $user->hasPermission('delete_Task');
    }
    public function view_Project(User $user, Project $project): bool
    {
        if ($user->hasRole(['Admin'])) {
            return true; // Admin has access to all projects
        }

        $userProject = $user->projectRoleAssignments()
            ->where('project_id', $project->id)
            ->exists();

        return $userProject;
    }

    public function add_Member(User $user): bool
    {
        return $user->hasRole(['Admin']) && $user->hasPermission('add_Member');
    }
}