<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Station;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $station = Station::first();

        if (!$station) {
            $this->command->warn('No station found. Please create a station first.');
            return;
        }

        Product::create([
            'station_id' => $station->id,
            'name' => 'Round Container',
            'price' => 25,
            'image' => 'products/rectangle-container.jpg',
            'is_active' => true,
        ]);

        Product::create([
            'station_id' => $station->id,
            'name' => 'Rectangle Container',
            'price' => 30,
            'image' => 'products/round-container.png',
            'is_active' => true,
        ]);
    }
}
