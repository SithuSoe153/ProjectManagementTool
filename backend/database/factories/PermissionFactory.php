<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $sequence = 0;

    public function definition(): array
    {
        $permissions = [
            'create_task' => 'Allows users to create new tasks',
            'view_task' => 'Allows users to view tasks',
            'update_task' => 'Allows users to update tasks',
            'delete_task' => 'Allows users to delete tasks',
            'create_project' => 'Allows users to create new projects',
            'view_project' => 'Allows users to view projects',
            'update_project' => 'Allows users to update projects',
            'delete_project' => 'Allows users to delete projects',

        ];


        $name = array_keys($permissions)[self::$sequence];
        self::$sequence++;

        return [
            'name' => $name,
            'description' => $permissions[$name],
        ];
    }
}