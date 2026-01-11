<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Station;
use App\Models\StationProduct;
use App\Models\User;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::find(2);

        // Refiller
        $refiller = User::create([
            'name' => 'Refiller',
            'email' => 'refiller@example.com',
            'password' => bcrypt('password'),
        ]);

        $refiller->assignRole('refiller');

        $station = Station::create([
            'name' => 'Station 1',
            'owner_id' => $owner->id,
            'user_id' => $refiller->id,
            'address' => 'Address 1',
            'latitude' => '12.345678',
            'longitude' => '12.345678',
            'status' => 'active',
        ]);

        $station->subscriptions()->create([
            'plan_id' => 1,
            'starts_at' => now(),
            'ends_at' => now()->addDays(30),
            'status' => 'paid',
            'last_payment_at' => null,
        ]);

        StationProduct::create([
            'station_id' => $station->id,
            'product_id' => 1,
            'price' => 30.00,
            'is_active' => true,
            'quantity' => 0,
            'has_stock_limit' => false,
        ]);

        StationProduct::create([
            'station_id' => $station->id,
            'product_id' => 3,
            'price' => 30.00,
            'is_active' => true,
            'quantity' => 0,
            'has_stock_limit' => false,
        ]);

        // Driver
        $driver = User::create([
            'name' => 'Driver',
            'email' => 'driver@example.com',
            'password' => bcrypt('password'),
        ]);

        $driver->assignRole('driver');

        Driver::create([
            'station_id' => $station->id,
            'user_id' => $driver->id,
            'is_active' => true,
            'name' => $driver->name,
            'phone' => '0123456789',
        ]);
    }
}
