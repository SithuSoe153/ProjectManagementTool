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

    public function updateTaskPositions(Request $request)
    {
        $taskIds = $request->input('taskIds');

        // Update task positions in the database
        foreach ($taskIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['position' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }



    public function store(Project $project, Task $task)
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

        // Remove selected_users from the cleaned data
        unset($cleanData['selected_users']);
        $newTask = $project->tasks()->create($cleanData);

        // Check if any members are selected
        if (request()->has('selected_users') && !empty(request()->selected_users)) {
            foreach (request()->selected_users as $userId) {
                // Create project role assignments for each selected user
                $existingMember = $newTask
                    ->users()
                    ->where('user_id', $userId)
                    ->exists();
                if (!$existingMember) {
                    $newTask->users()->attach($userId);
                }
            }
        }


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
    }

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
            'project' => $tasks->load('users'),
            'groupedTasks' => $groupedTasks,
            'roles' => Role::all(),
        ]);
    }
}