<?php

namespace App\Http\Controllers\Api\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CMS\AboutPage\AboutPageHeroSectionResource;
use App\Http\Resources\Api\CMS\AboutPage\AIPromptResource;
use App\Http\Resources\Api\CMS\AboutPage\FeatureResource;
use App\Http\Resources\Api\CMS\AboutPage\MissionStatementResource;
use App\Http\Resources\Api\CMS\AboutPage\PartnerSpotlightResource;
use App\Services\Api\CMS\AboutPageService;
use Exception;
use Illuminate\Http\JsonResponse;

class AboutPageController extends Controller {
    private AboutPageService $aboutPageService;
    public function __construct(AboutPageService $aboutPageService) {
        $this->aboutPageService = $aboutPageService;
    }

    /**
     * Fetch the About page data.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse {
        try {
            // Fetch data from the service.
            $data = $this->aboutPageService->getAboutPageData();

            // Transform each piece of data with the corresponding resource.
            $heroSection      = new AboutPageHeroSectionResource($data['hero_section']);
            $missionStatement = new MissionStatementResource($data['mission_statement']);
            $partnerSpotlight = new PartnerSpotlightResource($data['partner_spotlight']);
            $aiPrompt         = new AIPromptResource($data['ai_prompt']);
            $features         = FeatureResource::collection($data['features']);

            return Helper::jsonResponse(true, 'About page data fetched successfully', 200, [
                'hero_section'      => $heroSection,
                'mission_statement' => $missionStatement,
                'partner_spotlight' => $partnerSpotlight,
                'ai_prompt'         => $aiPrompt,
                'features'          => $features,
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
