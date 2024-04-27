<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'task_user');
    // }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}