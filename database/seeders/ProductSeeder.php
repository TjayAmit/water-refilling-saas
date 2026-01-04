<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Mineral Round Container',
            'image' => 'products/rectangle-container.jpg',
        ]);

        Product::create([
            'name' => 'Purify Round Container',
            'image' => 'products/rectangle-container.jpg',
        ]);

        Product::create([
            'name' => 'Mineral Rectangle Container',
            'image' => 'products/round-container.png',
        ]);

        Product::create([
            'name' => 'Purify Rectangle Container',
            'image' => 'products/round-container.png',
        ]);
    }
}
