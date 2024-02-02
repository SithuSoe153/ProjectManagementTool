<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
        $user = User::inRandomOrder()->first();
        $project = Project::inRandomOrder()->first();

        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
            'due_date' => $this->faker->date,
            'project_id' => $project->id,
            'user_id' => $user->id,
            'parent_task_id' => null, // Modify based on your requirements
            'position' => $this->faker->numberBetween(1, 10),
        ];
    }
}
