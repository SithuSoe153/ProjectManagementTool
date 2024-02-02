<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::all(),
        ]);
    }

    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project->load('tasks', 'users'),
        ]);
    }
}
