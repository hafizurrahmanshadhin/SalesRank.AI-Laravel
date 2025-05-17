<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AIPromptSeeder extends Seeder {
    public function run(): void {
        DB::table('a_i_prompts')->insert([
            [
                'id'         => 1,
                'title'      => 'Keeping Sales Teams Thriving with Expert Performance Solutions.',
                'image'      => 'seeder/salesteamimg.png',
                'created_at' => '2025-05-17 04:21:08',
                'updated_at' => '2025-05-17 04:28:01',
            ],
        ]);
    }
}
