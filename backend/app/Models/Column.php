<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'position', 'board_id'];

    public function kanbanBoard()
    {
        return $this->belongsTo(KanbanBoard::class, 'board_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'column_id');
    }
}