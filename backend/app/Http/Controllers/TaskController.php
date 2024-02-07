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

    public function toggleCompleted(Request $request)
    {

        $taskId = $request->task;
        $task = Task::find($taskId);
        if ($task) {
            $task->is_completed = !$task->is_completed;
            $task->save();
            // return response()->json(['success' => true]);
            return back()->with('toast', 'Complete Task');
        }

        return response()->json(['success' => false]);
    }
}