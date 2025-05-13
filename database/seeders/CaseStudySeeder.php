<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaseStudySeeder extends Seeder {
    public function run(): void {
        DB::table('case_studies')->insert([
            [
                'id'         => 1,
                'category'   => 'top notch seals people',
                'images'     => json_encode([
                    'seeder/hero1.png',
                    'seeder/hero2.png',
                    'seeder/hero3.png',
                ]),
                'status'     => 'active',
                'created_at' => '2025-05-13 08:45:22',
                'updated_at' => '2025-05-13 08:45:22',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'category'   => 'digital marketing',
                'images'     => json_encode([
                    'seeder/hero1.png',
                    'seeder/hero2.png',
                    'seeder/hero3.png',
                ]),
                'status'     => 'active',
                'created_at' => '2025-05-13 08:46:06',
                'updated_at' => '2025-05-13 08:46:06',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'category'   => 'branding',
                'images'     => json_encode([
                    'seeder/hero1.png',
                    'seeder/hero2.png',
                    'seeder/hero3.png',
                ]),
                'status'     => 'active',
                'created_at' => '2025-05-13 08:46:34',
                'updated_at' => '2025-05-13 08:46:34',
                'deleted_at' => null,
            ],
        ]);
    }
}
