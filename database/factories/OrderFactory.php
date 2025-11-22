<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference_id' => 'OL-' . now()->format('dmY') . '-' . $this->faker->unique()->numerify('####'),
            'user_id' => 2,
            'total_amount' => $this->faker->numberBetween(1000, 20000),
            'type' => $this->faker->randomElement(['government', 'walk_in', 'project_based', 'online']),
            'payment_method' => $this->faker->randomElement(['cheque', 'bank_transfer', 'cash', 'ewallet']),
            'customer_name' => $this->faker->name,
            'status' => 'completed',
            'created_at' => $this->faker->dateTimeBetween('-1 months', '-1 day'),
            'updated_at' => $this->faker->dateTimeBetween('-3 days', 'now')
        ];
    }
}
