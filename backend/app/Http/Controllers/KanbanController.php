<?php

namespace App\Http\Controllers;

use App\Models\Message;
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

    public function showMessage(Project $project)
    {
        $project->load(['tasks' => function ($query) {
            $query->orderBy('position', 'asc');
        }, 'tasks.users']);

        $projectId = $project->id;
        $messages = Message::where('project_id', $projectId)->get();

        return view('messages.index', [
            'tasks' => $project->tasks,
            'project' => $project,
            'roles' => Role::all(),
            'messages' => $messages,
        ]);
    }
}