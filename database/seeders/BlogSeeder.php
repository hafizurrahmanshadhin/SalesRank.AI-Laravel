<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder {
    public function run(): void {
        DB::table('blogs')->insert([
            [
                'id'          => 1,
                'title'       => 'How a Top Sales Person Can Boost Your Business',
                'description' => 'We are the top digital marketing agency for branding corp. We offer a full range of services...',
                'status'      => 'active',
                'created_at'  => '2025-05-15 06:58:24',
                'updated_at'  => '2025-05-15 06:58:24',
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'title'       => 'Why AI is the Future of Sales Performance',
                'description' => 'AI-driven insights are changing the way businesses hire and train top sales talent...',
                'status'      => 'active',
                'created_at'  => '2025-05-15 06:58:50',
                'updated_at'  => '2025-05-15 06:58:50',
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'title'       => 'Maximizing Revenue with AI-Powered Sales Strategies',
                'description' => 'Learn how to leverage AI to increase revenue and improve sales team efficiency...',
                'status'      => 'active',
                'created_at'  => '2025-05-15 06:59:14',
                'updated_at'  => '2025-05-15 06:59:14',
                'deleted_at'  => null,
            ],
        ]);
    }
}
