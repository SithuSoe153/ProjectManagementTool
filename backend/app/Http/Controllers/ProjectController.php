<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::latest()->get(),
        ]);
    }

    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project->load('tasks', 'users'),
        ]);
    }

    public function store(ProjectRequest $request)
    {

        $cleanData = $request->validated();
        $cleanData['user_id'] = auth()->id();
        // $cleanData['photo'] = request('photo')->store('/images');
        $newBlog = Project::create($cleanData);

        // SubscribeNewBlog::all()->each(function ($user) use ($newBlog) {
        //     Mail::to($user->email)->queue(new Subscriber($newBlog));
        // });
        return redirect('/')->with('success', 'Project Create Successful ' . $cleanData['title']);
    }

    public function create()
    {
        return view('projects.create');
    }
}
