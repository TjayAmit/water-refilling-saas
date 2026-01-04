<?php

namespace Database\Seeders;

use App\Models\Station;
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

        $station = Station::create([
            'name' => 'Station 1',
            'owner_id' => $owner->id,
            'address' => 'Address 1',
            'latitude' => '12.345678',
            'longitude' => '12.345678',
            'status' => 'active'
        ]);

        $station->subscriptions()->create([
            'plan_id' => 1,
            'starts_at' => now(),
            'ends_at' => now()->addDays(30),
            'status' => 'paid',
            'last_payment_at' => null,
        ]);
    }
}
