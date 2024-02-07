<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Plan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'plan_name' => 'Free',
                'price' => 0,
                'benefits' => 
                '1 Client
                Standart Tools
                Standart Contract',
            ],
            [
                'plan_name' => 'Premium',
                'price' => 100000,
                'benefits' => 'Unlimited Client
                Premium Tools
                Premium Contract',
            ],
        ];

        foreach ($plans as $plan) {
            \App\Models\Plan::create($plan);
        }
    }
}
