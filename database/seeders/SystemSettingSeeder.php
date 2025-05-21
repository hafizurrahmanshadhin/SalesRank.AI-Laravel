<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder {
    public function run(): void {
        DB::table('system_settings')->insert([
            [
                'id'             => 1,
                'title'          => 'SalesRank.AI',
                'system_name'    => 'SalesRank.AI',
                'email'          => 'Hey@boostim.com',
                'phone_number'   => '(406) 555-0120',
                'address'        => '2972 Westheimer Rd. Santa Ana, Illinois 85486',
                'copyright_text' => '© 2025 SalesRank.AI. All Rights Reserved.',
                'description'    => '<p>SalesRank.AI offers a comprehensive suite of AI-powered solutions to help you find expert sales professionals who can elevate every aspect of your business. From performance rankings and skill verification to industry benchmarking and real-time analytics, we provide the insights and tools to optimize your sales strategy and drive growth.</p>',
                'logo'           => null,
                'favicon'        => null,
                'created_at'     => '2025-05-09 23:00:00',
                'updated_at'     => '2025-05-21 03:02:45',
            ],
        ]);
    }
}
