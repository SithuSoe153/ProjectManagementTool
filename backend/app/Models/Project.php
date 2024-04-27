<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['name', 'description'];

    public function kanbanBoards()
    {
        return $this->hasMany(KanbanBoard::class);
    }

    public function meetingSessions()
    {
        return $this->hasMany(VideoCallSession::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_role_assignments');
    }

    public function project_role_assignments()
    {
        return $this->hasMany(ProjectRoleAssignment::class);
    }
}