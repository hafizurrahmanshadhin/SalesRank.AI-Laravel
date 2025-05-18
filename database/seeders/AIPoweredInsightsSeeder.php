<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AIPoweredInsightsSeeder extends Seeder {
    public function run(): void {
        DB::table('a_i_powered_insights')->insert([
            [
                'id'          => 1,
                'title'       => 'Reward Fulfillment Services',
                'description' => '<p>Logistics and fulfillment solutions to handle the distribution of rewards to backers.</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-18 09:58:58',
                'updated_at'  => '2025-05-18 09:58:58',
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'title'       => 'Crowdfunding Campaign Audits',
                'description' => '<p>Professional review and feedback on campaign performance to identify areas of improvement.</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-18 09:59:44',
                'updated_at'  => '2025-05-18 09:59:44',
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'title'       => 'Project Boosting Features',
                'description' => '<p>Paid options to feature and boost projects on the platform\'s homepage and newsletters.</p>',
                'status'      => 'active',
                'created_at'  => '2025-05-18 10:00:07',
                'updated_at'  => '2025-05-18 10:00:07',
                'deleted_at'  => null,
            ],
        ]);
    }
}
