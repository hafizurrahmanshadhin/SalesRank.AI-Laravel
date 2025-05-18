<?php

namespace App\Http\Controllers\Web\Backend\CMS\ConsultingPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ConsultingPageHeroSection;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ConsultingPageHeroSectionController extends Controller {
    /**
     * Display consulting page hero section.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $data = ConsultingPageHeroSection::firstOrNew();
            return view('backend.layouts.cms.consulting-page.hero-section', compact('data'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update consulting page hero section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'        => 'required|string',
                'description'  => 'required|string',
                'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:20480',
                'remove_image' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = ConsultingPageHeroSection::firstOrNew();

            $data->title       = $request->title;
            $data->description = $request->description;

            //* Handle image file
            if ($request->boolean('remove_image')) {
                if ($data->image) {
                    Helper::fileDelete(public_path($data->image));
                    $data->image = null;
                }
            } elseif ($request->hasFile('image')) {
                if ($data->image) {
                    Helper::fileDelete(public_path($data->image));
                }
                $data->image = Helper::fileUpload($request->file('image'), 'consultingPageHeroSection', $data->image);
            }
            $data->save();

            return redirect()->route('cms.consulting-page.hero-section.index')->with('t-success', 'Consulting page hero section updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
