<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesEvaluationBannerSeeder extends Seeder {
    public function run(): void {
        DB::table('sales_evaluation_banners')->insert([
            'id'         => 1,
            'title'      => 'Data-Driven Sales Evaluation: Measuring What Truly Matters',
            'image'      => 'seeder/evaluation1.png',
            'created_at' => Carbon::create(2025, 5, 19, 6, 49, 38, 'UTC'),
            'updated_at' => Carbon::create(2025, 5, 19, 6, 49, 38, 'UTC'),
        ]);
    }
}
