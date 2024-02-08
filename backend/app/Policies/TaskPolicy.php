<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }



    public function create_Task(User $user): bool
    {
        return ($user->hasRole(['Admin']) || $user->hasRole(['Manager']) && $user->hasPermission('create_Task'));
    }

    public function update_Task(User $user): bool
    {
        return $user->hasRole(['Admin', 'Manager']) && $user->hasPermission('delete_Task');
    }

    public function delete_Task(User $user): bool
    {
        return $user->hasRole(['Admin', 'Manager']) && $user->hasPermission('delete_Task');
    }

    public function check_Task(User $user): bool
    {
        return $user->hasRole(['Admin']) || $user->hasPermission('check_Task');
    }
}