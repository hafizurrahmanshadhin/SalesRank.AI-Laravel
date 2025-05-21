<?php

namespace App\Services\Api\CMS;

use App\Models\AIPoweredInsights;
use App\Models\ConsultingPageHeroSection;
use App\Models\GrowthStoryBanner;
use App\Models\SalesEvaluationBanner;
use Exception;

class ConsultingPageService {
    /**
     * Fetch and prepare data for the Consulting page.
     *
     * @return array
     * @throws Exception
     */
    public function getConsultingPageData(): array {
        try {
            $heroSection       = ConsultingPageHeroSection::first();
            $AIPoweredInsights = AIPoweredInsights::where('status', 'active')->get();
            $growthStory       = GrowthStoryBanner::first();
            $salesEvaluation   = SalesEvaluationBanner::first();

            return [
                'hero_section'        => $heroSection,
                'ai_powered_insights' => $AIPoweredInsights,
                'growth_story'        => $growthStory,
                'sales_evaluation'    => $salesEvaluation,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
