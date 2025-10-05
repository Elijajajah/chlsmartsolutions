<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();

        $product = [
            'serial_number' => $this->faker->regexify('(SN|SSD)-[0-9]{10,14}'),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 100, 3000),
            'category_id' => $category->id,
        ];

        return $product;
    }

    public function configure()
    {
        return $this->afterCreating(function ($product) {
            Inventory::factory()->create([
                'product_id' => $product->id,
            ]);
        });
    }
}
