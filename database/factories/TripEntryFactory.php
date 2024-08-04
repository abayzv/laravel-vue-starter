<?php

namespace Database\Factories;

use App\Models\Trip;
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
        $trip_id = fake()->numberBetween(1, 50);
        $trip = Trip::find($trip_id);

        return [
            'trip_id' => $trip_id,
            'outlet_id' => fake()->numberBetween(1, 10),
            'quantity' => fake()->numberBetween(10, 30),
            'price' => fake()->randomElement([6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000]),
            'paid_status' => fake()->boolean(),
            'payment_method' => fake()->randomElement(['transfer', 'cash']),
            'created_at' => $trip->created_at
        ];
    }
}
