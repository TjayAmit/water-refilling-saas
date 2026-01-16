<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Driver;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'tristanjayamit0813@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $super_admin->assignRole('super_admin');

        // Owner
        $owner = User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
        ]);

        $owner->assignRole('owner');

        // Customer
        $customer = User::create([
            'name' => 'Customer',
            'email' => 'customer@example',
            'password' => bcrypt('password'),
        ]);

        $customer->assignRole('customer');

        Customer::create([
            'name' => 'John Doe',
            'phone' => '0123456789',
            'address' => 'Address',
            'user_id' => $customer->id,
            'latitude' => '12.345678',
            'longitude' => '12.345678',
            'is_trusted' => true
        ]);
    }
}
