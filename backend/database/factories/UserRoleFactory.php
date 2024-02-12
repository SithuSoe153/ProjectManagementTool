<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static $sequence = 0;

    public function definition(): array
    {
        $roles = [
            '1' => '1',
            '2' => '3',
            '3' => '2',

        ];

        // $name = $this->faker->unique()->randomElement(array_keys($roles));
        $name = array_keys($roles)[self::$sequence];
        self::$sequence++;

        return [
            'user_id' => $name,
            'role_id' => $roles[$name],
        ];
    }
}