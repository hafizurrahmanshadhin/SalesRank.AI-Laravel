<?php

namespace App\Http\Controllers\Web\Backend\CMS\PricingPage;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionPlanController extends Controller {
    public function index(): View {
        $plans = SubscriptionPlan::get();
        return view('backend.layouts.cms.pricing-page.subscription-plan', compact('plans'));
    }
    /**
     * Show the form for editing the specified resource of subscription plans.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    // public function update(Request $request, int $id): JsonResponse {
    //     $validator = Validator::make($request->all(), [
    //         'price'             => 'required|numeric',
    //         'billing_cycle'     => 'required|in:monthly,yearly,lifetime',
    //         'touch_points'      => 'nullable|integer|min:0',
    //         'has_ads'           => 'required|boolean',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'errors' => $validator->errors()]);
    //     }

    //     $subscriptionPlan = Plan::findOrFail($id);

    //     try {
    //         $subscriptionPlan->update([
    //             'price'             => $request->price,
    //             'billing_cycle'     => $request->billing_cycle,
    //             'touch_points'      => $request->touch_points,
    //             'has_ads'           => $request->has_ads,
    //         ]);

    //         return response()->json(['success' => true, 'message' => 'Subscription plan updated successfully.']);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while updating the Subscription plan: ' . $e->getMessage(),
    //         ]);
    //     }
    // }

    public function toggleStatus(SubscriptionPlan $subscription_plan): RedirectResponse {
        $subscription_plan->status = $subscription_plan->status === 'active'
        ? 'inactive'
        : 'active';
        $subscription_plan->save();

        return redirect()
            ->route('cms.pricing-page.subscription-plan.index')
            ->with('t-success', 'Plan status updated.');
    }
}
