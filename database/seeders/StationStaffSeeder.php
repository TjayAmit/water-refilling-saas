<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Driver
        $driver = User::create([
            'name' => 'Driver',
            'email' => 'driver@example',
            'password' => bcrypt('password'),
        ]);

        $driver->assignRole('driver', 'web');

        Driver::create([
            'name' => 'Johny Doe',
            'station_id' => 1,
            'user_id' => $driver->id,
            'phone' => '0123456789',
            'is_active' => true,
        ]);

        // Refiller
        $refiller = User::create([
            'name' => 'Refiller',
            'email' => 'refiller@example',
            'password' => bcrypt('password'),
        ]);

        $refiller->assignRole('refiller', 'web');

        $station = Station::find(1);

        $station->user()->associate($refiller);
    }
}
