<?php

namespace Database\Seeders;

use Database\Seeders\AboutPageHeroSectionSeeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\BlogsPreviewSeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\FAQSeeder;
use Database\Seeders\FeatureBlockSeeder;
use Database\Seeders\HomePageHeroSectionSeeder;
use Database\Seeders\HomePageVideoBannerSectionSeeder;
use Database\Seeders\MissionStatementSeeder;
use Database\Seeders\NewsletterSeeder;
use Database\Seeders\PartnerSpotlightSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SocialMediaSeeder;
use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\TestimonialSeeder;
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
            FeatureBlockSeeder::class,
            TestimonialSeeder::class,
            BlogsPreviewSeeder::class,
            BlogSeeder::class,
            NewsletterSeeder::class,
            AboutPageHeroSectionSeeder::class,
            MissionStatementSeeder::class,
            PartnerSpotlightSeeder::class,
        ]);
    }
}
