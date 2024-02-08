<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectRoleAssignment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->latest()->get();

        $assignedProjects = auth()->user()->projectRoleAssignments;


        return view('projects.index', [
            'projects' => $projects->load('tasks.users'),
            'assignedProjects' => $assignedProjects->load('project'),
        ]);
    }


    public function show(Project $project)
    {
        $project->load(['tasks' => function ($query) {
            $query->orderBy('position', 'asc');
        }, 'tasks.users']);

        return view('projects.show', [
            'project' => $project,
            'roles' => Role::all(),
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


    public function update(ProjectRequest $request, Project $project)
    {

        $cleanData = $request->validated();
        $cleanData['user_id'] = $request->user()->id;
        // dd($cleanData);
        // $cleanData['photo'] = request('photo')->store('/images');
        $project->update($cleanData);

        // SubscribeNewBlog::all()->each(function ($user) use ($newBlog) {
        //     Mail::to($user->email)->queue(new Subscriber($newBlog));
        // });
        return redirect('/')->with('success', 'Project Update Successful ' . $cleanData['title']);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', $project->title . ' Deleted Successfully');
    }

    public function create()
    {
        return view('projects.create');
    }


    public function storeMembers(Request $request, Project $project)
    {

        // Validate the request
        $cleanData = $request->validate([
            'email' => 'required|email',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Find the user with the provided email

        $user = User::where('email', $request['email'])->first();

        // Ensure the user is found
        if (!$user) {
            return redirect()->back()->with('error', 'User not found with the provided email.');
        }

        // Create or update members in the database
        foreach ($request->input('roles') as $roleId) {
            // Check if the assignment already exists
            $existingAssignment = ProjectRoleAssignment::where('project_id', $project->id)
                ->where('user_id', $user->id)
                ->where('role_id', $roleId)
                ->exists();

            if (!$existingAssignment) {
                // Create a new assignment only if it doesn't exist
                $project->project_role_assignments()->create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                    'assign_user_id' => auth()->id(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Members added successfully.');
    }
}