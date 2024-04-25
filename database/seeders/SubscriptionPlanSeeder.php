<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'subscription_plan_name' => 'Basic Plan',
                'price' => 60000,
                'discount' => 0.0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subscription_plan_name' => 'Premium Plan',
                'price' => 100000,
                'discount' => 0.0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subscription_plan_name' => 'Platinum Plan',
                'price' => 150000,
                'discount' => 0.0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('subscription_plans')->insert($plans);
    }
}
