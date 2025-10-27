<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\ProductSerial;
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
            'supplier' => $this->faker->words(3, true),
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph(),
            'original_price' => $this->faker->randomFloat(2, 100, 3000),
            'retail_price' => $this->faker->randomFloat(2, 100, 3000),
            'min_limit' => $this->faker->numberBetween(4, 6),
            'category_id' => $category->id,
        ];

        return $product;
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $serialCount = rand(8, 10);

            for ($i = 0; $i < $serialCount; $i++) {
                ProductSerial::create([
                    'product_id' => $product->id,
                    'serial_number' => strtoupper('SN-' . uniqid() . '-' . rand(100, 999)),
                    'status' => 'available',
                ]);
            }
        });
    }
}
