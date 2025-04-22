<?php

namespace Database\Seeders;

use Database\Seeders\FAQSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SystemSettingSeeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            SystemSettingSeeder::class,
            FAQSeeder::class,
        ]);
    }
}
