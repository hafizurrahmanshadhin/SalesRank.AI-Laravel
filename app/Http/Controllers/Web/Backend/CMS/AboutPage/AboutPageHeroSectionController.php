<?php

namespace App\Http\Controllers\Web\Backend\CMS\AboutPage;

use App\Http\Controllers\Controller;
use App\Models\AboutPageHeroSection;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AboutPageHeroSectionController extends Controller {
    /**
     * Display the hero section.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $heroSection = AboutPageHeroSection::firstOrNew();
            return view('backend.layouts.cms.about-page.hero-section', compact('heroSection'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the hero section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $heroSection = AboutPageHeroSection::firstOrNew();

            $heroSection->title       = $request->title;
            $heroSection->description = $request->description;
            $heroSection->save();

            return redirect()->route('cms.about-page.hero-section.index')->with('t-success', 'Hero section updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
