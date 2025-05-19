<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrowthStorySeeder extends Seeder {
    public function run(): void {
        DB::table('growth_stories')->insert([
            [
                'id'         => 1,
                'title'      => 'Credibility',
                'image'      => 'seeder/consulting1.png',
                'status'     => 'active',
                'created_at' => Carbon::create(2025, 5, 19, 4, 28, 31, 'UTC'),
                'updated_at' => Carbon::create(2025, 5, 19, 4, 28, 31, 'UTC'),
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'title'      => 'Higher Earning Potential',
                'image'      => 'seeder/consulting2.png',
                'status'     => 'active',
                'created_at' => Carbon::create(2025, 5, 19, 4, 28, 43, 'UTC'),
                'updated_at' => Carbon::create(2025, 5, 19, 4, 28, 43, 'UTC'),
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'title'      => 'Know Your Rank',
                'image'      => 'seeder/consulting3.png',
                'status'     => 'active',
                'created_at' => Carbon::create(2025, 5, 19, 4, 28, 55, 'UTC'),
                'updated_at' => Carbon::create(2025, 5, 19, 4, 28, 55, 'UTC'),
                'deleted_at' => null,
            ],
        ]);
    }
}
