<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KanbanBoard extends Model
{
    use HasFactory;


    protected $table = 'kanban'; // Specifying the table name if different from the default

    protected $fillable = ['title', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function columns()
    {
        return $this->hasMany(Column::class, 'board_id');
    }
}
