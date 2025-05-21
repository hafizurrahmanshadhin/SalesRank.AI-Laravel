<?php

namespace App\Http\Controllers\Api\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CMS\ConsultingPage\AIPoweredInsightsResource;
use App\Http\Resources\Api\CMS\ConsultingPage\ConsultingPageHeroSectionResource;
use App\Http\Resources\Api\CMS\ConsultingPage\GrowthStoryBannerResource;
use App\Http\Resources\Api\CMS\ConsultingPage\SalesEvaluationBannerResource;
use App\Services\Api\CMS\ConsultingPageService;
use Exception;
use Illuminate\Http\JsonResponse;

class ConsultingPageController extends Controller {
    private ConsultingPageService $consultingPageService;
    public function __construct(ConsultingPageService $consultingPageService) {
        $this->consultingPageService = $consultingPageService;
    }

    /**
     * Fetch, transform, and return the consulting page data.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse {
        try {
            // Fetch data from the service.
            $data = $this->consultingPageService->getConsultingPageData();

            // Transform each piece of data with the corresponding resource.
            $heroSection       = new ConsultingPageHeroSectionResource($data['hero_section']);
            $AIPoweredInsights = AIPoweredInsightsResource::collection($data['ai_powered_insights']);
            $growthStory       = new GrowthStoryBannerResource($data['growth_story']);
            $salesEvaluation   = new SalesEvaluationBannerResource($data['sales_evaluation']);

            return Helper::jsonResponse(true, 'Consulting page data fetched successfully', 200, [
                'hero_section'        => $heroSection,
                'ai_powered_insights' => $AIPoweredInsights,
                'growth_story'        => $growthStory,
                'sales_evaluation'    => $salesEvaluation,
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
