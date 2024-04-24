<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\KanbanBoard;
use App\Models\Task;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    //
    public function storeColumn(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required|integer|exists:projects,id', // Assume project_id is sent from the form
        ]);

        // Check if Kanban board exists for the given project
        $kanban = KanbanBoard::firstOrCreate([
            'project_id' => $request->project_id,
            'user_id' => auth()->id(), // Assuming the user is authenticated
        ], [
            'title' => 'Default Title', // Default title or take from request if applicable
        ]);


        // Determine the new position for the column
        $newPosition = Column::where('board_id', $kanban->id)->max('position') + 1;

        // Create a new column in the kanban board
        $column = new Column([
            'title' => $request->title,
            'board_id' => $kanban->id,
            'position' => $newPosition,
        ]);
        $column->save();

        // Update all null column_id tasks related to the project
        Task::whereNull('column_id')
            ->whereHas('project', function ($query) use ($request) {
                $query->where('id', $request->project_id);
            })
            ->update(['column_id' => $column->id]);




        return redirect()->back()->with('success', 'Column added successfully!');
    }
}