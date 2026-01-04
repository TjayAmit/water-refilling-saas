<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionPlan::create([
            'name' => 'Standard',
            'price' => 999,
            'max_drivers' => 1,
            'max_branches' => 2,
            'features' => '[]',
            'is_active' => true
        ]);

        SubscriptionPlan::create([
            'name' => 'Premium',
            'price' => 1500,
            'max_drivers' => 3,
            'max_branches' => 5,
            'features' => '[]',
            'is_active' => true
        ]);
    }
}
