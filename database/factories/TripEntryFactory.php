<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripEntry>
 */
class TripEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trip_id' => fake()->numberBetween(1, 15),
            'outlet_id' => fake()->numberBetween(1, 10),
            'quantity' => fake()->numberBetween(10, 30),
            'price' => fake()->numberBetween(5000, 10000),
            'paid_status' => fake()->boolean(),
            'payment_method' => fake()->randomElement(['transfer', 'cash'])
        ];
    }
}
