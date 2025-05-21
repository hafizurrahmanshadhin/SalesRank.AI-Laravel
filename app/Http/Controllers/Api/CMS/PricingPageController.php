<?php

namespace App\Http\Controllers\Api\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CMS\CollaborationResource;
use App\Http\Resources\Api\CMS\PricingPage\PricingPageHeroSectionResource;
use App\Http\Resources\Api\CMS\PricingPage\SubscriptionPlanResource;
use App\Http\Resources\Api\CMS\TestimonialResource;
use App\Services\Api\CMS\PricingPageService;
use Exception;
use Illuminate\Http\JsonResponse;

class PricingPageController extends Controller {
    private PricingPageService $pricingPageService;
    public function __construct(PricingPageService $pricingPageService) {
        $this->pricingPageService = $pricingPageService;
    }

    /**
     * Single action: Fetch, transform, and return the pricing page data.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(): JsonResponse {
        try {
            // Fetch data from the service.
            $data = $this->pricingPageService->getPricingPageData();

            // Use the corresponding resources for each data set.
            $heroSection       = new PricingPageHeroSectionResource($data['hero_section']);
            $subscriptionPlans = SubscriptionPlanResource::collection($data['subscription_plans']);
            $collaboration     = new CollaborationResource($data['collaboration']);
            $testimonials      = TestimonialResource::collection($data['testimonials']);

            return Helper::jsonResponse(true, 'Pricing page data fetched successfully', 200, [
                'hero_section'       => $heroSection,
                'subscription_plans' => $subscriptionPlans,
                'collaboration'      => $collaboration,
                'testimonials'       => $testimonials,
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
