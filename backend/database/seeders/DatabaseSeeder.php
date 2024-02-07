<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\UserRole;
use Database\Factories\TaskUserFactory;
use Database\Factories\UserRoleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory(10)->create();

        // Create three users with manual data

        User::create([
            'name' => 'aAdminuser',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('kmd123'),
        ]);

        User::create([
            'name' => 'Testuser',
            'email' => 'test@gmail.com',
            'password' => bcrypt('kmd123'),
        ]);

        // User::create([
        //     'name' => 'User1',
        //     'email' => 'user1@example.com',
        //     'password' => bcrypt('password1'),
        // ]);

        UserRole::factory(2)->create();

        // Fetch all users
        $user =  User::join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->where('user_roles.role_id', 1)
            ->get();

        // Loop through each user to associate projects and tasks
        // foreach ($users as $user) {
        // Create two projects for each user
        $project1 = Project::create([
            'user_id' => $user->first()->id,
            'title' => 'Project 1 for ' . $user->first()->name,
            'start_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        $project2 = Project::create([
            'user_id' => $user->last()->id,
            'title' => 'Project 2 for ' . $user->first()->name,
            'start_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        // Create two tasks for each project
        Task::create([
            'user_id' => $user->first()->id,
            'project_id' => $project1->id,
            'title' => 'Task 1 for ' . $user->first()->name,
            // Add other task attributes here
        ]);

        Task::create([
            'user_id' => $user->first()->id,
            'project_id' => $project1->id,
            'title' => 'Task 2 for ' . $user->first()->name,
            // Add other task attributes here
        ]);

        Task::create([
            'user_id' => $user->first()->id,
            'project_id' => $project2->id,
            'title' => 'Task 1 for ' . $user->first()->name,
            // Add other task attributes here
        ]);

        Task::create([
            'user_id' => $user->first()->id,
            'project_id' => $project2->id,
            'title' => 'Task 2 for ' . $user->first()->name,
            // Add other task attributes here
        ]);
    }

    // Role::factory(10)->create();

    // $user = User::factory(3)
    //     ->has(
    //         Project::factory(2)
    //             ->has(
    //                 Task::factory(3)
    //             )
    //     )
    //     ->create()
    //     ->each(function ($user) {
    //         // Get all existing users and roles
    //         $roles = Role::all();

    //         // Retrieve tasks for the user's projects
    //         $tasks = $user->projects->flatMap->tasks;

    //         // Attach a new random user to each task
    //         $tasks->each(function ($task) use ($roles) {
    //             $randomRoles = $roles->random(2); // Limit to 2 random roles

    //             $UserId = User::factory()->create();
    //             $task->users()->attach($UserId->id);
    //             $UserId->roles()->attach($randomRoles->pluck('id'));
    //         });
    //     });

    // $managerRole = Role::where('name', 'Manager')->first();

    // $user->take(3)->each(function ($user) use ($managerRole) {
    //     $user->roles()->attach($managerRole);
    // });
}
// }