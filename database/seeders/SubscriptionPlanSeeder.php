<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder {
    public function run(): void {
        $subscriptionPlans = [
            [
                'name'             => 'Free Search',
                'billing_interval' => 'month',
                'price'            => 0.00,
                'currency'         => 'USD',
                'description'      => 'Limited access, search up to 10 ranked profiles, basic profile data, limited filters',
                'features'         => [
                    'Limited Access',
                    'Search up to 10 ranked profiles',
                    'Basic profile data',
                    'Limited filters',
                ],
                'is_recommended'   => false,
                'status'           => 'active',
            ],
            [
                'name'             => 'Premium Search',
                'billing_interval' => 'month',
                'price'            => 20.00,
                'currency'         => 'USD',
                'description'      => 'Unlimited access, search up to 100 ranked profiles, detailed profile data, advanced filters',
                'features'         => [
                    'Unlimited Access',
                    'Search up to 100 ranked profiles',
                    'Detailed profile data',
                    'Advanced filters',
                ],
                'is_recommended'   => false,
                'status'           => 'active',
            ],
            [
                'name'             => 'Ultimate Search',
                'billing_interval' => 'year',
                'price'            => 200.00,
                'currency'         => 'USD',
                'description'      => 'Unlimited access, search up to 500 ranked profiles, full profile data, premium filters',
                'features'         => [
                    'Unlimited Access',
                    'Search up to 500 ranked profiles',
                    'Full profile data',
                    'Premium filters',
                ],
                'is_recommended'   => true,
                'status'           => 'active',
            ],
        ];

        foreach ($subscriptionPlans as $plan) {
            SubscriptionPlan::updateOrCreate(
                ['name' => $plan['name']],
                $plan
            );
        }
    }
}
