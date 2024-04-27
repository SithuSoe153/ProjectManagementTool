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

        $users = User::all();


        return view('projects.index', [
            'projects' => $projects->load('tasks.users'),
            'assignedProjects' => $assignedProjects->load('project'),
            'users' => $users,
        ]);
    }

    public function show(Project $project)
    {
        $project->load(['tasks' => function ($query) {
            $query->orderBy('position', 'asc');
        }, 'tasks.users']);

        return view('projects.show', [
            'tasks' => $project->tasks,
            'project' => $project,
            'roles' => Role::all(),
        ]);
    }



    public function store(ProjectRequest $request)
    {

        $cleanData = $request->validated();
        $cleanData['user_id'] = auth()->id();

        // Remove selected_users from the cleaned data
        unset($cleanData['selected_users']);

        $project = Project::create($cleanData);
        // Check if any members are selected
        if ($request->has('selected_users') && !empty($request->selected_users)) {
            foreach ($request->selected_users as $userId) {
                // Create project role assignments for each selected user
                $project->project_role_assignments()->create([
                    'user_id' => $userId,
                    'assign_user_id' => auth()->id(),
                    // 'role_id' => 7,
                ]);
            }
        }

        return redirect('/')->with('success', 'Project created successfully.');
    }




    // public function store(ProjectRequest $request)
    // {
    //     dd($request->all());
    //     $cleanData = $request->validated();
    //     $cleanData['user_id'] = auth()->id();
    //     // $cleanData['photo'] = request('photo')->store('/images');
    //     $newBlog = Project::create($cleanData);

    //     // SubscribeNewBlog::all()->each(function ($user) use ($newBlog) {
    //     //     Mail::to($user->email)->queue(new Subscriber($newBlog));
    //     // });
    //     return redirect('/')->with('success', 'Project Create Successful ' . $cleanData['title']);
    // }


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
        // Validate the request for email and optionally for roles
        $validatedData = $request->validate([
            'email' => 'required|email',
            'roles' => 'sometimes|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Find the user with the provided email
        $user = User::where('email', $validatedData['email'])->firstOrFail();

        // Determine roles to assign: use provided roles or fetch user's current roles
        $roleIds = $request->filled('roles') ? $validatedData['roles'] : $user->roles->pluck('id')->toArray();

        // Sync roles to ensure user has only specified roles for this project
        $projectRoleAssignments = $project->project_role_assignments()->where('user_id', $user->id);
        $existingRoleIds = $projectRoleAssignments->pluck('role_id')->toArray();

        $rolesToAdd = array_diff($roleIds, $existingRoleIds);
        $rolesToRemove = array_diff($existingRoleIds, $roleIds);

        foreach ($rolesToAdd as $roleId) {
            $project->project_role_assignments()->create([
                'user_id' => $user->id,
                'role_id' => $roleId,
                'assign_user_id' => auth()->id(),
            ]);
        }

        if (!empty($rolesToRemove)) {
            $projectRoleAssignments->whereIn('role_id', $rolesToRemove)->delete();
        }

        return redirect()->back()->with('success', 'Members updated successfully.');
    }
}