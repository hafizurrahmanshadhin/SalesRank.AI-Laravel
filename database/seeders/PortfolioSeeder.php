<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder {
    public function run(): void {
        Portfolio::insert([
            [
                'id'           => 1,
                'user_id'      => 2,
                'project_path' => 'seeder/PortfolioProject_1.pdf',
                'status'       => 'active',
                'created_at'   => '2025-05-22 09:24:52',
                'updated_at'   => '2025-05-22 09:24:52',
            ],
            [
                'id'           => 2,
                'user_id'      => 2,
                'project_path' => 'seeder/PortfolioProject_2.pdf',
                'status'       => 'active',
                'created_at'   => '2025-05-22 09:24:54',
                'updated_at'   => '2025-05-22 09:24:54',
            ],
            [
                'id'           => 3,
                'user_id'      => 2,
                'project_path' => 'seeder/PortfolioProject_3.pdf',
                'status'       => 'active',
                'created_at'   => '2025-05-22 09:24:55',
                'updated_at'   => '2025-05-22 09:24:55',
            ],
            [
                'id'           => 4,
                'user_id'      => 2,
                'project_path' => 'seeder/PortfolioProject_4.pdf',
                'status'       => 'active',
                'created_at'   => '2025-05-22 09:26:00',
                'updated_at'   => '2025-05-22 09:26:00',
            ],
        ]);
    }
}
