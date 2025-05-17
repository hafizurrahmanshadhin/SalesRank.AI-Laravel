<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PricePageHeroSectionSeeder extends Seeder {
    public function run(): void {
        DB::table('price_page_hero_sections')->insert([
            [
                'id'          => 1,
                'title'       => 'Hire With Confidence - No More Guesswork',
                'sub_title'   => 'Our affordable pricing options make it possible.',
                'image'       => 'seeder/priceimg1.png',
                'description' => '<p>At our firm, we strive to deliver the highest quality design services while providing exceptional value to our clients. We offer competitive rates for all our services, including architectural design, interior design, project management, and furniture design, with pricing tailored to factors such as project scope, level of customization, and timeline.</p>',
                'created_at'  => Carbon::parse('2025-05-17 09:04:22'),
                'updated_at'  => Carbon::parse('2025-05-17 09:04:22'),
            ],
        ]);
    }
}
