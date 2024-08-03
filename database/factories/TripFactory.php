<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
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
            'departure_date' => fake()->date(),
            'departure_time' => fake()->time(),
            'stock' => fake()->numberBetween(200, 300),
            'vehicle_id' => fake()->numberBetween(1, 5)
        ];
    }
}
