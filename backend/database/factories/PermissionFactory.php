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
            'create_Task' => 'Allows users to create new tasks', //1
            'view_Task' => 'Allows users to view tasks', //2
            'update_Task' => 'Allows users to update tasks', //3
            'delete_Task' => 'Allows users to delete tasks', //4
            'check_Task' => 'Allows users to delete tasks', //5

            'create_Project' => 'Allows users to create new projects', //6
            'view_Project' => 'Allows users to view projects', //7
            'update_Project' => 'Allows users to update projects', //8
            'delete_Project' => 'Allows users to delete projects', //9

            'create_Member' => 'Allows users to create new members', //10
            'view_Member' => 'Allows users to view members', //11
            'update_Member' => 'Allows users to update members', //12
            'delete_Member' => 'Allows users to delete members', //13
            'add_Member' => 'Allows users to delete members', //14
            'assign_Member' => 'Allows users to delete members', //15

        ];


        $name = array_keys($permissions)[self::$sequence];
        self::$sequence++;

        return [
            'name' => $name,
            'description' => $permissions[$name],
        ];
    }
}