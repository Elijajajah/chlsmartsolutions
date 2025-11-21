<?php

namespace Database\Factories;

use App\Models\TechnicianRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition()
    {
        $user = [
            'fullname' => 'Danica Oliveria',
            'email' => 'customer@gmail.com',
            'phone_number' => $this->faker->unique()->numerify('9#########'),
            'password' => Hash::make('chlsmartsolutions'),
            'role' => 'customer',
        ];

        return $user;
    }

    public function owner(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jiro Elijah Aguilar',
            'role' => 'owner',
            'email' => 'chladmin@gmail.com',
        ]);
    }

    public function customer(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Danica Oliveria',
            'role' => 'customer',
            'email' => 'customer@gmail.com',
        ]);
    }

    public function cashier(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jallien Resaba',
            'role' => 'cashier',
            'email' => 'chlcashier@gmail.com',
        ]);
    }

    public function technician(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Alessandra Mingi',
            'role' => 'technician',
            'email' => 'chltechnician@gmail.com',
        ]);
    }

    public function adminOfficer(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jiro Elijah Aguilar',
            'role' => 'admin_officer',
            'email' => 'chladminofficer@gmail.com',
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function ($user) {
            if ($user->role != 'technician') {
                return;
            }
            TechnicianRole::factory()->create([
                'user_id' => $user->id,
                'role' => 'main',
            ]);
        });
    }
}
