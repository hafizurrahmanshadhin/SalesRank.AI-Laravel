<?php

namespace Database\Seeders;

use Database\Seeders\CaseStudySeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\FAQSeeder;
use Database\Seeders\HomePageHeroSectionSeeder;
use Database\Seeders\HomePageVideoBannerSectionSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SocialMediaSeeder;
use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

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
            HomePageHeroSectionSeeder::class,
            HomePageVideoBannerSectionSeeder::class,
            CaseStudySeeder::class,
        ]);
    }
}
