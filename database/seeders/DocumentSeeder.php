<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder {
    public function run(): void {
        DB::table('documents')->insert([
            'id'              => 1,
            'generate_script' => 'backend/images/calendar.png',
            'practice_pitch'  => 'backend/images/calendar.png',
            'created_at'      => Carbon::parse('2025-05-19 10:14:34'),
            'updated_at'      => Carbon::parse('2025-05-19 10:14:43'),
        ]);
    }
}
