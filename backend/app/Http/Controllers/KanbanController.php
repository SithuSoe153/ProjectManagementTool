<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Request;

class KanbanController extends Controller
{

    public function showkanban(Project $project)
    {
        $project->load(['tasks' => function ($query) {
            $query->orderBy('position', 'asc');
        }, 'tasks.users']);

        return view('projects.kanban', [
            'tasks' => $project->tasks,
            'project' => $project,
            'roles' => Role::all(),
        ]);
    }
}