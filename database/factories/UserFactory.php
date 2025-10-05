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
            'username' => 'jirocustomer',
            'phone_number' => $this->faker->unique()->numerify('9#########'),
            'password' => Hash::make('jirojiro'),
            'role' => 'customer',
        ];

        return $user;
    }

    public function admin(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jiro Elijah Aguilar',
            'role' => 'admin',
            'username' => 'jiroadmin',
        ]);
    }

    public function customer(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Danica Oliveria',
            'role' => 'customer',
            'username' => 'jirocustomer',
        ]);
    }

    public function cashier(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jallien Resaba',
            'role' => 'cashier',
            'username' => 'jirocashier',
        ]);
    }

    public function technician(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Alessandra Mingi',
            'role' => 'technician',
            'username' => 'jirotechnician',
        ]);
    }

    public function adminOfficer(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jiro Elijah Aguilar',
            'role' => 'admin_officer',
            'username' => 'jiroadminofficer',
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
