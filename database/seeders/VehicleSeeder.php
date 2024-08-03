<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::factory()->create([
            'name' => 'Mobil 1'
        ]);
        Vehicle::factory()->create([
            'name' => 'Mobil 2'
        ]);
        Vehicle::factory()->create([
            'name' => 'Mobil 3'
        ]);
        Vehicle::factory()->create([
            'name' => 'Mobil 4'
        ]);
        Vehicle::factory()->create([
            'name' => 'Mobil 5'
        ]);
    }
}
