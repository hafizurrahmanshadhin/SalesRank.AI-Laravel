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
                'email'          => 'sales@rank.ai',
                'phone_number'   => '0123456789',
                'address'        => 'Dhaka, Bangladesh',
                'copyright_text' => '©SalesRank.AI',
                'description'    => '<p>About System...</p>',
                'logo'           => null,
                'favicon'        => null,
                'created_at'     => '2025-05-10 05:00:00',
                'updated_at'     => '2025-05-10 05:00:00',
            ],
        ]);
    }
}
