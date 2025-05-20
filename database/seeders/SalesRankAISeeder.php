<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesRankAISeeder extends Seeder {
    public function run(): void {
        DB::table('sales_rank_a_i_s')->insert([
            [
                'id'          => 1,
                'title'       => 'Everything You Need to Know About SalesRank.AI',
                'description' => "<p>Your go-to guide for understanding how our AI-powered platform can elevate your sales team's performance and drive business success.</p>",
                'created_at'  => '2025-05-20 05:56:51',
                'updated_at'  => '2025-05-20 05:56:51',
            ],
        ]);
    }
}
