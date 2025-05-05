<?php

namespace Database\Seeders;

use Database\Seeders\FAQSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\SocialMediaSeeder;
use Database\Seeders\SystemSettingSeeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            SystemSettingSeeder::class,
            FAQSeeder::class,
            DynamicPageSeeder::class,
            SocialMediaSeeder::class,
            ContentSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
