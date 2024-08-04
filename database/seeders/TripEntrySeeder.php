<?php

namespace Database\Seeders;

use App\Models\TripEntry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TripEntry::factory(250)->create();
    }
}
