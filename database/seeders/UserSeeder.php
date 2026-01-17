<?php

namespace Database\Seeders;

use App\Models\Customer;
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

        $customer = Customer::create([
            'name' => 'John Doe',
            'phone' => '0123456789',
            'email' => 'customer@example.com',
            'address' => 'Address',
            'is_trusted' => true
        ]);

        $customer->assignRole('customer', 'web');
    }
}
