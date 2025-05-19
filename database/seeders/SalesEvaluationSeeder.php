<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesEvaluationSeeder extends Seeder {
    public function run(): void {
        DB::table('sales_evaluations')->insert([
            [
                'id'          => 1,
                'title'       => 'Total Revenue Closed',
                'description' => '<p>The total revenue from closed deals in a given period, showing sales impact.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create(2025, 5, 19, 6, 50, 28, 'UTC'),
                'updated_at'  => Carbon::create(2025, 5, 19, 6, 50, 28, 'UTC'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'title'       => 'Average Deal Size',
                'description' => '<p>The average value of each deal closed within a specific period.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create(2025, 5, 19, 6, 50, 54, 'UTC'),
                'updated_at'  => Carbon::create(2025, 5, 19, 6, 50, 54, 'UTC'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'title'       => 'Close Rate',
                'description' => '<p>The % of deals closed compared to the total number of opportunities.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create(2025, 5, 19, 6, 51, 16, 'UTC'),
                'updated_at'  => Carbon::create(2025, 5, 19, 6, 51, 16, 'UTC'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 4,
                'title'       => 'Industries Served',
                'description' => '<p>The sectors benefiting from our sales solutions.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create(2025, 5, 19, 6, 51, 36, 'UTC'),
                'updated_at'  => Carbon::create(2025, 5, 19, 6, 51, 36, 'UTC'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 5,
                'title'       => 'Deal Velocity',
                'description' => '<p>The speed at which deals move through the sales pipeline.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create(2025, 5, 19, 6, 52, 3, 'UTC'),
                'updated_at'  => Carbon::create(2025, 5, 19, 6, 52, 3, 'UTC'),
                'deleted_at'  => null,
            ],
        ]);
    }
}
