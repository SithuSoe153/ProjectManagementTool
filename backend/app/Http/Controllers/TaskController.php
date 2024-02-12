<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class TaskController extends Controller
{
    public function store(Project $project)
    {
        $cleanData = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'due_date' => ['required'],
        ]);

        $cleanData['user_id'] = auth()->id();
        $cleanData['project_id'] = $project->id;
        // Get the last task's position and increment by 1
        $cleanData['position'] = $project->tasks()->max('position') + 1;

        $newTask = $project->tasks()->create($cleanData);

        return back()->with('success', 'Task Added Successfully');
    }

    public function assignMembers(Request $request, Task $task)
    {
        $assignedMembers = $request->input('members', []);

        foreach ($assignedMembers as $userId) {
            $existingMember = $task
                ->users()
                ->where('user_id', $userId)
                ->exists();
            if (!$existingMember) {
                $task->users()->attach($userId);
            }
        }

        return back()->with('success', 'Task Assigned Successfully');
        // Redirect or return a response
    }

    // public function toggleCompleted(Request $request)
    // {
    //     dd($request->all());
    //     $taskId = $request->task;
    //     $task = Task::find($taskId);
    //     if ($task) {
    //         $task->is_completed = !$task->is_completed;
    //         $task->save();
    //         return response()->json(['success' => true]);
    //         // return back()->with('toast', 'Complete Task');
    //     }

    //     return response()->json(['success' => false]);
    // }


    public function toggleCompleted(Request $request)
    {
        $task = Task::find($request->task);

        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $task->update([
            'is_completed' => !$task->is_completed,
        ]);

        return response()->json(['success' => true, 'task' => $task]);
    }




    public function update(Task $task)
    {

        // dd($task);
        $cleanData = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'due_date' => [],
        ]);
        $cleanData['user_id'] = $task->user_id;
        // dd($cleanData);
        // $cleanData['photo'] = request('photo')->store('/images');
        $task->update($cleanData);

        return back()->with('success', 'Task Update Successful ' . $cleanData['title']);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', $task->title . ' Deleted Successfully');
    }

    // public function index()
    // {

    //     $tasks = auth()->user()->tasks->load('project');
    //     // $project = $tasks->load('project');
    //     return view('tasks.index', [
    //         'tasks' => $tasks,
    //         // 'project' => $project,
    //         // 'project' => $tasks->first()->project,
    //         'roles' => Role::all(),
    //     ]);
    // }

    // public function index()
    // {

    //     $tasks = auth()->user()->tasks->load('project');

    //     // Group tasks by project
    //     $groupedTasks = $tasks->groupBy('project_id');

    //     return view('tasks.index', [
    //         'project' => $tasks->first()->project,
    //         'groupedTasks' => $groupedTasks,
    //         'roles' => Role::all(),
    //     ]);
    // }


    public function index()
    {
        // Retrieve tasks associated with the authenticated user
        $tasks = auth()->user()->tasks->load('project');

        // Group tasks by project
        $groupedTasks = $tasks->groupBy('project_id');

        // Filter tasks within each project group to include only those associated with the authenticated user
        foreach ($groupedTasks as $projectId => $projectTasks) {
            $filteredTasks = $projectTasks->filter(function ($task) {
                return $task->users->contains(auth()->user());
            });
            $groupedTasks[$projectId] = $filteredTasks;
        }


        return view('tasks.index', [
            // 'project' => $tasks->first()->project->tasks->first()->users->first()->id,
            'project' => $tasks->load('users'),
            'groupedTasks' => $groupedTasks,
            'roles' => Role::all(),
        ]);
    }



    // public function index()
    // {
    //     $user = auth()->user();
    //     $tasks = $user->tasks()->with('project')->get(); // Eager load the project relationship

    //     // Ensure there's at least one task to avoid accessing properties on null
    //     $firstProject = $tasks->first() ? $tasks->first()->project : null;

    //     return view('tasks.index', [
    //         'tasks' => $tasks,
    //         'projects' => $tasks->pluck('project')->unique(), // Assuming you want a list of unique projects from tasks
    //         'project' => $firstProject,
    //         'roles' => Role::all(),
    //     ]);
    // }

    // public function index()
    // {
    //     $user = auth()->user();

    //     // Assuming there's a 'task_user' pivot table for the many-to-many relationship
    //     // Adjust 'tasks' to match the actual method name in your User model
    //     $tasks = $user->tasks()->with('project')->get();
    //     // Assuming each task belongs to a project and you want to list projects separately
    //     $projects = $user->projects()->distinct()->get(); // Adjust based on your actual relationship/method

    //     return view('tasks.index', [
    //         'tasks' => $tasks,
    //         'projects' => $projects,
    //         'roles' => Role::all(),
    //     ]);
    // }

    // public function index()
    // {
    //     $user = auth()->user();

    //     // Retrieve all tasks directly associated with the user
    //     $tasks = $user->tasks()->with('project')->get();

    //     // Extract unique projects from the tasks
    //     $projects = $tasks->pluck('project')->unique()->values();

    //     // Return the view with the tasks, projects, and roles
    //     return view('tasks.index', [
    //         'tasks' => $tasks,
    //         'projects' => $projects,
    //         'roles' => Role::all(),
    //     ]);
    // }
}