<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Database\Factories\TaskUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory()
        //     ->count(5)
        //     ->create()
        //     ->each(function ($user) {
        //         $user->projects()->saveMany(
        //             Project::factory()
        //                 ->count(3)
        //                 ->create()
        //                 ->each(function ($project) {
        //                     $project->tasks()->saveMany(Task::factory()->count(10)->make());
        //                 })
        //         );
        //     });

        // User::factory()
        //     ->has(
        //         Project::factory()->count(3)
        //             ->has(Task::factory()->count(10))
        //     )
        //     ->create();

        Role::factory(10)->create();

        $user = User::factory(3)
            ->has(
                Project::factory(2)
                    ->has(
                        Task::factory(3)
                    )
            )
            ->create()
            ->each(function ($user) {
                // Get all existing users and roles
                $roles = Role::all();

                // Retrieve tasks for the user's projects
                $tasks = $user->projects->flatMap->tasks;

                // Attach a new random user to each task
                $tasks->each(function ($task) use ($roles) {
                    $randomRoles = $roles->random(2); // Limit to 2 random roles

                    $UserId = User::factory()->create();
                    $task->users()->attach($UserId->id);
                    $UserId->roles()->attach($randomRoles->pluck('id'));
                });
            });

        $managerRole = Role::where('name', 'Manager')->first();

        $user->take(3)->each(function ($user) use ($managerRole) {
            $user->roles()->attach($managerRole);
        });
    }
}
