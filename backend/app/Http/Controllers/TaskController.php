<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Project $project)
    {
        $cleanData = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'due_date' => ['required'],
            'position' => [1],
        ]);

        $cleanData['user_id'] = auth()->id();
        $cleanData['project_id'] = $project->id;
        $newTask = $project->tasks()->create($cleanData);

        return back()->with('success', 'Task Added Successfully');
    }
}
