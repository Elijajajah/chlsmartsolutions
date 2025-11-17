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
            'username' => 'customer',
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
            'username' => 'chladmin',
        ]);
    }

    public function customer(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Danica Oliveria',
            'role' => 'customer',
            'username' => 'customer',
        ]);
    }

    public function cashier(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jallien Resaba',
            'role' => 'cashier',
            'username' => 'chlcashier',
        ]);
    }

    public function technician(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Alessandra Mingi',
            'role' => 'technician',
            'username' => 'chltechnician',
        ]);
    }

    public function adminOfficer(): static
    {
        return $this->state(fn() => [
            'fullname' => 'Jiro Elijah Aguilar',
            'role' => 'admin_officer',
            'username' => 'chladminofficer',
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