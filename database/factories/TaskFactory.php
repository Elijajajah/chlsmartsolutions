<?php

namespace Database\Factories;

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
            'title' => $this->faker->randomElement(['technical support', 'maintenance', 'installation', 'troubleshooting assistance', 'device resets', 'usage guidance']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'description' => $this->faker->paragraph(),
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->unique()->numerify('9#########'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'missed']),
            'user_id' => 4,
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
        ];
    }
}
