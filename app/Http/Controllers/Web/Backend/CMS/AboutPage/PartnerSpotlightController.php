<?php

namespace App\Http\Controllers\Web\Backend\CMS\AboutPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\PartnerSpotlight;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PartnerSpotlightController extends Controller {
    /**
     * Display partner spotlight.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $partnerSpotlight = PartnerSpotlight::firstOrNew();
            return view('backend.layouts.cms.about-page.partner-spotlight', compact('partnerSpotlight'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update Partner Spotlight.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'        => 'required|string',
                'description'  => 'required|string',
                'image'        => 'required|image|mimes:jpg,jpeg,png,gif|max:20480',
                'remove_image' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $partnerSpotlight = PartnerSpotlight::firstOrNew();

            $partnerSpotlight->title       = $request->title;
            $partnerSpotlight->description = $request->description;

            //* Handle image file
            if ($request->boolean('remove_image')) {
                if ($partnerSpotlight->image) {
                    Helper::fileDelete(public_path($partnerSpotlight->image));
                    $partnerSpotlight->image = null;
                }
            } elseif ($request->hasFile('image')) {
                if ($partnerSpotlight->image) {
                    Helper::fileDelete(public_path($partnerSpotlight->image));
                }
                $partnerSpotlight->image = Helper::fileUpload($request->file('image'), 'partnerSpotlight', $partnerSpotlight->image);
            }
            $partnerSpotlight->save();

            return redirect()->route('cms.about-page.partner-spotlight.index')->with('t-success', 'Partner spotlight updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
