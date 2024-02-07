<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static $sequence = 0;

    public function definition()
    {
        $roles = [
            'Admin' => 'Administrator role',
            'Manager' => 'Manager role',
            'Employee' => 'Employee role',
            'Supervisor' => 'Supervisor role',
            'Developer' => 'Developer role',
            'Designer' => 'Designer role',
            'Tester' => 'Tester role',
            'Analyst' => 'Business Analyst role',
            'Support' => 'Customer Support role',
            'Sales' => 'Sales role',
        ];


        // $name = $this->faker->unique()->randomElement(array_keys($roles));
        $name = array_keys($roles)[self::$sequence];
        self::$sequence++;

        return [
            'name' => $name,
            'description' => $roles[$name],
        ];
    }
}