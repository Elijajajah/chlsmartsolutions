<?php

namespace Database\Seeders;

use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->admin()->create();
        User::factory()->customer()->create();
        User::factory()->cashier()->create();
        User::factory()->technician()->create();
        User::factory()->adminOfficer()->create();

        $categories = [
            'Laptops & Desktops',
            'Smartphones & Gadgets',
            'Printers',
            'Computer Accessories',
            'Power & Charging Solutions',
            'Audio & Video Devices',
            'CCTV & Security Systems',
            'Networking Devices',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        Product::factory()->count(20)->create();
        Task::factory()->count(15)->create();
        Order::factory()->count(20)->create();
        Expense::factory()->count(30)->create();
    }
}
