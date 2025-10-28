<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'service_category_id' => null,
            'service' => 'Default',
            'price' => fake()->randomFloat(2, 100, 3000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Service $service) {
            // No extra behavior needed for now
        });
    }

    /**
     * Seed predefined service categories and their related services.
     */
    public static function createDefaultServices()
    {
        $categories = [
            'Technical Support' => [
                'Phone Support',
                'Computer Maintenance',
            ],
            'Maintenance' => [
                'Computer Maintenance',
                'Software Updates',
            ],
            'Installation' => [
                'Signal Installation',
                'Software Installation',
            ],
            'Troubleshooting' => [
                'Internet Issues',
                'Slow Performance',
            ],
            'Device Reset' => [
                'Factory Reset',
                'Password Reset',
            ],
            'User Guidance' => [
                'Device Tutorial',
                'Software Training',
            ],
        ];
        $faker = fake();

        foreach ($categories as $categoryName => $services) {
            // ✅ Create the parent category
            $category = ServiceCategory::create([
                'category' => $categoryName,
            ]);

            // ✅ Create each child service
            foreach ($services as $serviceName) {
                Service::create([
                    'service_category_id' => $category->id,
                    'service' => $serviceName,
                    'price' => $faker->randomFloat(2, 100, 3000),
                ]);
            }
        }
    }
}
