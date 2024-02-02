<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'description' => fake()->text,
            'due_date' => fake()->date,
            'project_id' => factory(App\Project::class),
            'user_id' => factory(App\User::class),
            'parent_task_id' => null, // To be modified based on your requirements
            'position' => fake()->randomNumber(),
        ];
    }
}
