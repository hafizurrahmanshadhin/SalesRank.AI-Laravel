<?php

namespace App\Http\Controllers\Web\Backend\CMS\AICoachPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\AICoachPageHeroSection;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AICoachPageHeroSectionController extends Controller {
    /**
     * Display the hero section.
     *
     * @return RedirectResponse|View
     * @throws Exception
     */
    public function index(): RedirectResponse | View {
        try {
            $data = AICoachPageHeroSection::firstOrNew();
            return view('backend.layouts.cms.ai-coach-page.hero-section', compact('data'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the hero section.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'           => 'required|string',
                'image'           => 'nullable|image|mimes:jpg,jpeg,png,gif|max:20480',
                'description'     => 'required|string',
                'remove_image'    => 'nullable|boolean',
                'sub_title'       => 'required|string',
                'sub_description' => 'required|string',
                'banner'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:20480',
                'remove_banner'   => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = AICoachPageHeroSection::firstOrNew();

            $data->title           = $request->title;
            $data->description     = $request->description;
            $data->sub_title       = $request->sub_title;
            $data->sub_description = $request->sub_description;

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
                $data->image = Helper::fileUpload($request->file('image'), 'aICoachPageHeroSection', $data->image);
            }

            //* Handle banner file
            if ($request->boolean('remove_banner')) {
                if ($data->banner) {
                    Helper::fileDelete(public_path($data->banner));
                    $data->banner = null;
                }
            } elseif ($request->hasFile('banner')) {
                if ($data->banner) {
                    Helper::fileDelete(public_path($data->banner));
                }
                $data->banner = Helper::fileUpload($request->file('banner'), 'aICoachPageHeroSection', $data->banner);
            }
            $data->save();

            return redirect()->route('cms.ai-coach-page.hero-section.index')->with('t-success', 'AI Coach page hero section updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
