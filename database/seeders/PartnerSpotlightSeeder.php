<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSpotlightSeeder extends Seeder {
    public function run(): void {
        DB::table('partner_spotlights')->insert([
            [
                'id'          => 1,
                'title'       => 'Your Partner in Sales Excellence and Business Success.',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore dolor sit amet, consectetur</p>',
                'image'       => 'seeder/excelency.png',
                'created_at'  => '2025-05-15 12:03:23',
                'updated_at'  => '2025-05-15 12:05:10',
            ],
        ]);
    }
}
