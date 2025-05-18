<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultingPageHeroSectionSeeder extends Seeder {
    public function run(): void {
        DB::table('consulting_page_hero_sections')->insert([
            [
                'id'          => 1,
                'title'       => "Want to Prove You're Among the Best?",
                'image'       => 'seeder/consultingbg.png',
                'description' => '<p>Submit Your Data. Get Your Score. Stand Out.</p>',
                'created_at'  => '2025-05-15 10:57:19',
                'updated_at'  => '2025-05-15 10:58:52',
            ],
        ]);
    }
}
