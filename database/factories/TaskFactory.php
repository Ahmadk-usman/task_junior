<?php

namespace Database\Factories;

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
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(3),
            'description' => $this->faker->paragraph(2),
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'completed']),
            // 'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'user_id' => function () {
                return User::query()->inRandomOrder()->value('id') ?? User::factory()->create()->id;
            },
        ];
    }
}
