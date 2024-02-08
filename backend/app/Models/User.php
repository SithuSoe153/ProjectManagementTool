<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function projectRoleAssignments()
    {
        return $this->hasMany(ProjectRoleAssignment::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user');
    }

    public function show(User $user)
    {
        return view('auth.profile', ['user' => $user]);
    }

    public function hasRole(array $roleNames): bool
    {
        // Check if the user has any of the specified roles
        return $this->roles()->whereIn('name', $roleNames)->exists();
    }

    public function hasPermission(string $permissionName): bool
    {
        // Check if any of the user's roles have the specified permission
        return $this->roles()->whereHas('permissions', function ($query) use ($permissionName) {
            $query->where('name', $permissionName);
        })->exists();
    }
}