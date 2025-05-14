<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsPreviewSeeder extends Seeder {
    public function run(): void {
        DB::table('blogs_previews')->insert([
            [
                'id'          => 1,
                'title'       => 'AI-Powered Sales Ranking & Performance Solutions That Drive Growth and Boost Revenue',
                'description' => '<p>Unlock the potential of your sales team with AI-driven insights, performance rankings, and industry benchmarks to accelerate growth and maximize revenue.</p>',
                'created_at'  => '2025-05-14 11:47:23',
                'updated_at'  => '2025-05-14 11:47:23',
            ],
        ]);
    }
}
