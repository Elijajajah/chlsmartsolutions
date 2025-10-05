<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    protected $model = Expense::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement([
                'monthly dues',
                'employee salary',
                'supplies & materials',
                'miscellaneous',
                'other expenses',
            ]),
            'amount' => $this->faker->numberBetween(100, 10000),
            'expense_date' => $this->faker->dateTimeBetween('first day of January this year', 'now')->format('Y-m-d'),
            'remarks' => $this->faker->paragraph(),
        ];
    }
}
