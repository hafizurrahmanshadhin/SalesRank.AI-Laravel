<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder {
    public function run(): void {
        DB::table('roles')->insert([
            [
                'name'       => 'admin',
                'slug'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'sales_professional',
                'slug'       => 'sales_professional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'hiring_company',
                'slug'       => 'hiring_company',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
