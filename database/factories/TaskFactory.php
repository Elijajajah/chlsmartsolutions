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
            'user_id' => 3,
            'technician_id' => 4,
            'service_id' => ServiceCategory::inRandomOrder()->value('id'),
            'customer_name' => $this->faker->name,
            'customer_phone' => $this->faker->unique()->numerify('9#########'),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['government', 'walk_in', 'project_based', 'online']),
            'tax' => $this->faker->numberBetween(5, 10),
            'price' => fake()->randomFloat(2, 100, 3000),
            'payment_method' => $this->faker->randomElement(['cheque', 'bank_transfer', 'cash', 'ewallet']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled', 'unassigned']),
        ];
    }
}
