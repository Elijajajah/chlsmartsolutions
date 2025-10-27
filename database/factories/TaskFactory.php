<?php

namespace Database\Factories;

use App\Models\ServiceCategory;
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
        return [
            'service_id' => ServiceCategory::inRandomOrder()->value('id'),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'description' => $this->faker->paragraph(),
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->unique()->numerify('9#########'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'missed', 'unassigned', 'overdue']),
            'user_id' => 4,
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
        ];
    }
}
