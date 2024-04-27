<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\VideoCallSession;
use Illuminate\Http\Request;

class MeetingController extends Controller
{

    public function showMeeting(Project $project)
    {
        $project->load(['tasks' => function ($query) {
            $query->orderBy('position', 'asc');
        }, 'tasks.users']);

        return view('meetings.index', [
            'tasks' => $project->tasks,
            'project' => $project,
            'roles' => Role::all(),
        ]);
    }

    public function showVideoCallSession(Project $project)
    {

        return view('meetings.show');
    }


    public function store(Project $project)
    {
        // dd(request()->all());
        $cleanData = request()->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // dd($project);
        $cleanData['user_id'] = auth()->id();
        $cleanData['project_id'] = $project->id;

        $videoCallSession = VideoCallSession::create($cleanData);

        return back()
            ->with('success', 'Video call session created successfully.');
    }
}