<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutPageHeroSectionSeeder extends Seeder {
    public function run(): void {
        DB::table('about_page_hero_sections')->insert([
            [
                'id'          => 1,
                'title'       => 'Built by Sales Pros. Backed by Real Data.',
                'description' => '<p>Crafted by Sales Professionals, Powered by Cutting-Edge AI, and Backed by Real-World Data to Elevate Performance, Drive Growth, and Transform Sales Success.</p>',
                'created_at'  => '2025-05-15 10:57:19',
                'updated_at'  => '2025-05-15 10:58:52',
            ],
        ]);
    }
}
