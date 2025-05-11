<?php

namespace App\Http\Controllers\Web\Backend\CMS\HomePage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\HomePageHeroSection;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomePageHeroSectionController extends Controller {
    /**
     * Display the hero section.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $heroSection = HomePageHeroSection::firstOrNew();
            return view('backend.layouts.cms.home-page.hero-section', compact('heroSection'));
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
                'title'        => 'required|string',
                'description'  => 'required|string',
                'image'        => 'required|image|mimes:jpg,jpeg,png,gif|max:20480',
                'remove_image' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $heroSection = HomePageHeroSection::firstOrNew();

            $heroSection->title       = $request->title;
            $heroSection->description = $request->description;

            //* Handle image file
            if ($request->boolean('remove_image')) {
                if ($heroSection->image) {
                    Helper::fileDelete(public_path($heroSection->image));
                    $heroSection->image = null;
                }
            } elseif ($request->hasFile('image')) {
                if ($heroSection->image) {
                    Helper::fileDelete(public_path($heroSection->image));
                }
                $heroSection->image = Helper::fileUpload($request->file('image'), 'heroSection', $heroSection->image);
            }
            $heroSection->save();

            return redirect()->route('cms.home-page.hero-section.index')->with('t-success', 'Hero section updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
