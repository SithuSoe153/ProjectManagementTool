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
            'create_Task' => 'Allows users to create new tasks',
            'view_Task' => 'Allows users to view tasks',
            'update_Task' => 'Allows users to update tasks',
            'delete_Task' => 'Allows users to delete tasks',
            'check_Task' => 'Allows users to delete tasks',

            'create_Project' => 'Allows users to create new projects',
            'view_Project' => 'Allows users to view projects',
            'update_Project' => 'Allows users to update projects',
            'delete_Project' => 'Allows users to delete projects',

        ];


        $name = array_keys($permissions)[self::$sequence];
        self::$sequence++;

        return [
            'name' => $name,
            'description' => $permissions[$name],
        ];
    }
}