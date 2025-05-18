<?php

namespace App\Http\Controllers\Web\Backend\CMS\PricingPage;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller {
    public function index() {
        $plans = SubscriptionPlan::get();
        return view('backend.layouts.cms.pricing-page.subscription-plan', compact('plans'));
    }

    public function toggleStatus(SubscriptionPlan $subscription_plan) {
        $subscription_plan->status = $subscription_plan->status === 'active' ? 'inactive' : 'active';
        $subscription_plan->save();

        return redirect()->route('cms.pricing-page.subscription-plan.index')->with('t-success', 'Plan status updated.');
    }

    public function toggleRecommended(SubscriptionPlan $subscription_plan) {
        // If this plan is being set as recommended, first remove recommended status from all plans
        if (!$subscription_plan->is_recommended) {
            SubscriptionPlan::where('is_recommended', true)->update(['is_recommended' => false]);
        }

        // Toggle the recommended status for this plan
        $subscription_plan->is_recommended = !$subscription_plan->is_recommended;
        $subscription_plan->save();

        return redirect()->route('cms.pricing-page.subscription-plan.index')
            ->with('t-success', $subscription_plan->is_recommended ? 'Plan set as recommended.' : 'Plan removed from recommended.');
    }
}
