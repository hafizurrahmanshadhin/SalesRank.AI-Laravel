<?php

namespace App\Services\Api\CMS;

use App\Models\AboutPageHeroSection;
use App\Models\AIPrompt;
use App\Models\Feature;
use App\Models\MissionStatement;
use App\Models\PartnerSpotlight;
use Exception;

class AboutPageService {
    /**
     * Fetch and prepare data for the About page.
     *
     * @return array
     * @throws Exception
     */
    public function getAboutPageData(): array {
        try {
            $heroSection      = AboutPageHeroSection::first();
            $missionStatement = MissionStatement::first();
            $partnerSpotlight = PartnerSpotlight::first();
            $aiPrompt         = AIPrompt::first();
            $features         = Feature::where('status', 'active')->get();

            return [
                'hero_section'      => $heroSection,
                'mission_statement' => $missionStatement,
                'partner_spotlight' => $partnerSpotlight,
                'ai_prompt'         => $aiPrompt,
                'features'          => $features,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
