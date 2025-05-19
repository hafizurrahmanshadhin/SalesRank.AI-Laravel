<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrowthStoryBannerSeeder extends Seeder {
    public function run(): void {
        DB::table('growth_story_banners')->insert([
            'id'         => 1,
            'title'      => 'Your Growth Story Starts Here. Speak with Our Experts Today.',
            'created_at' => Carbon::create(2025, 5, 19, 4, 27, 13, 'UTC'),
            'updated_at' => Carbon::create(2025, 5, 19, 4, 27, 13, 'UTC'),
        ]);
    }
}
