<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AICoachPageHeroSectionSeeder extends Seeder {
    public function run(): void {
        DB::table('a_i_coach_page_hero_sections')->insert([
            'id'              => 1,
            'title'           => 'Your AI-Powered Sales Coach',
            'image'           => 'seeder/aiavatar1.png',
            'description'     => '<p>Get real-time coaching, script suggestions, and deal-closing strategies powered by advanced AI technology.</p>',
            'banner'          => 'seeder/aihero.png',
            'sub_title'       => 'Growth is our priority.',
            'sub_description' => '<p>As a full-service business agency, we specialize in helping companies of all sizes optimize their operations.</p>',
            'created_at'      => Carbon::create(2025, 5, 19, 8, 48, 54, 'UTC'),
            'updated_at'      => Carbon::create(2025, 5, 19, 8, 52, 59, 'UTC'),
        ]);
    }
}
