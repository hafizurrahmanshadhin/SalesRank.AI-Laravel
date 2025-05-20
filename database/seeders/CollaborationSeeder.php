<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollaborationSeeder extends Seeder {
    public function run(): void {
        DB::table('collaborations')->insert([
            [
                'id'          => 1,
                'title'       => 'Frequently asked questions',
                'description' => "<p>Constant collaboration is how we roll. Let's see if we are a good fit.</p>",
                'created_at'  => '2025-05-20 05:57:46',
                'updated_at'  => '2025-05-20 05:57:46',
            ],
        ]);
    }
}
