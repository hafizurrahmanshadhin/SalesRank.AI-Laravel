<?php

namespace Database\Seeders;

use Database\Seeders\AboutPageHeroSectionSeeder;
use Database\Seeders\AICoachPageHeroSectionSeeder;
use Database\Seeders\AIPoweredInsightsSeeder;
use Database\Seeders\AIPromptSeeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\BlogsPreviewSeeder;
use Database\Seeders\ConsultingPageHeroSectionSeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\DocumentSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\FAQSeeder;
use Database\Seeders\FeatureBlockSeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\GrowthStoryBannerSeeder;
use Database\Seeders\GrowthStorySeeder;
use Database\Seeders\HomePageHeroSectionSeeder;
use Database\Seeders\HomePageVideoBannerSectionSeeder;
use Database\Seeders\MissionStatementSeeder;
use Database\Seeders\NewsletterSeeder;
use Database\Seeders\PartnerSpotlightSeeder;
use Database\Seeders\PricePageHeroSectionSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SalesEvaluationBannerSeeder;
use Database\Seeders\SalesEvaluationSeeder;
use Database\Seeders\SocialMediaSeeder;
use Database\Seeders\SubscriptionPlanSeeder;
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
            AIPromptSeeder::class,
            FeatureSeeder::class,
            PricePageHeroSectionSeeder::class,
            SubscriptionPlanSeeder::class,
            ConsultingPageHeroSectionSeeder::class,
            AIPoweredInsightsSeeder::class,
            GrowthStoryBannerSeeder::class,
            GrowthStorySeeder::class,
            SalesEvaluationBannerSeeder::class,
            SalesEvaluationSeeder::class,
            AICoachPageHeroSectionSeeder::class,
            DocumentSeeder::class,
        ]);
    }
}
