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
        return ($user->hasRole(['Admin', 'Manager']) && $user->hasPermission('create_Task'));
    }

    public function update_Task(User $user): bool
    {
        return $user->hasRole(['Admin', 'Manager']) && $user->hasPermission('update_Task');
    }

    public function delete_Task(User $user): bool
    {
        return $user->hasRole(['Admin', 'Manager']) && $user->hasPermission('delete_Task');
    }

    public function check_Task(User $user, Task $task): bool
    {
        $userTask = $task->users()->where('user_id', $user->id)->first();
        return $userTask ? $userTask->id == $user->id : false || $user->hasRole(['Admin', 'Manager']);
    }

    public function view_Task(User $user): bool
    {
        return $user->hasRole(['Admin']) || $user->hasPermission('check_Task');
    }

    public function assign_Member(User $user): bool
    {
        return $user->hasRole(['Admin', 'Member']) || $user->hasPermission('assign_Member');
    }
}