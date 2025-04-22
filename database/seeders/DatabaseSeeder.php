<?php

namespace Database\Seeders;

use Database\Seeders\ProfileSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
        ]);
    }
}
