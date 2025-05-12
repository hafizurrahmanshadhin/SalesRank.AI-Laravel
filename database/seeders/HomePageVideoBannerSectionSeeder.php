<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageVideoBannerSectionSeeder extends Seeder {
    public function run(): void {
        DB::table('home_page_video_banner_sections')->insert([
            [
                'id'              => 1,
                'title'           => 'Delivering top-tier sales person with groundbreaking AI innovation.',
                'description'     => '<p>Objective Rankings: SalesRank Scores (70-100) based on real performance - not hype. Industry-Specific Filters: From SaaS to Real Estate to Medical Sales, we rank the best in each field. Projected Revenue Impact: See how much revenue each consultant could bring to your business - before you hire.</p>',
                'video'           => null,
                'video_thumbnail' => 'seeder/delevery2.png',
                'created_at'      => '2025-05-12 06:24:46',
                'updated_at'      => '2025-05-12 06:24:46',
            ],
        ]);
    }
}
