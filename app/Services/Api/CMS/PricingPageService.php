<?php

namespace App\Services\Api\CMS;

use App\Models\Collaboration;
use App\Models\PricePageHeroSection;
use App\Models\SubscriptionPlan;
use App\Models\Testimonial;
use Exception;

class PricingPageService {
    /**
     * Fetch and prepare data for the Pricing page.
     *
     * @throws Exception
     * @return array
     * @throws Exception
     */
    public function getPricingPageData(): array {
        try {
            $heroSection       = PricePageHeroSection::first();
            $subscriptionPlans = SubscriptionPlan::where('status', 'active')->get();
            $collaboration     = Collaboration::first();
            $testimonials      = Testimonial::where('status', 'active')->get();

            return [
                'hero_section'       => $heroSection,
                'subscription_plans' => $subscriptionPlans,
                'collaboration'      => $collaboration,
                'testimonials'       => $testimonials,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
