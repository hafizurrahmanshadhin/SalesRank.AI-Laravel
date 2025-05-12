<?php

namespace App\Http\Controllers\Web\Backend\CMS\HomePage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\HomePageVideoBannerSection;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomePageVideoBannerSectionController extends Controller
{
    /**
     * Display the video banner section.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse|View
    {
        try {
            $videoBanner = HomePageVideoBannerSection::firstOrNew();
            return view('backend.layouts.cms.home-page.video-banner', compact('videoBanner'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the video banner section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'title'                => 'required|string',
                'description'          => 'required|string',
                'video'                => 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg|max:102400',
                'remove_video'         => 'nullable|boolean',
                'video_thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
                'remove_video_thumbnail' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $videoBanner = HomePageVideoBannerSection::firstOrNew();

            $videoBanner->title       = $request->title;
            $videoBanner->description = $request->description;

            // Handle video file
            if ($request->has('remove_video') && $request->boolean('remove_video')) {
                if ($videoBanner->video) {
                    Helper::fileDelete(public_path($videoBanner->video));
                    $videoBanner->video = null;
                }
            } elseif ($request->hasFile('video')) {
                if ($videoBanner->video) {
                    Helper::fileDelete(public_path($videoBanner->video));
                }
                $videoBanner->video = Helper::fileUpload($request->file('video'), 'videoBanner', $videoBanner->video);
            }

            // Handle video thumbnail
            if ($request->has('remove_video_thumbnail') && $request->boolean('remove_video_thumbnail')) {
                if ($videoBanner->video_thumbnail) {
                    Helper::fileDelete(public_path($videoBanner->video_thumbnail));
                    $videoBanner->video_thumbnail = null;
                }
            } elseif ($request->hasFile('video_thumbnail')) {
                if ($videoBanner->video_thumbnail) {
                    Helper::fileDelete(public_path($videoBanner->video_thumbnail));
                }
                $videoBanner->video_thumbnail = Helper::fileUpload($request->file('video_thumbnail'), 'videoBannerThumbnails', $videoBanner->video_thumbnail);
            }

            $videoBanner->save();

            return redirect()->route('cms.home-page.video-banner.index')->with('t-success', 'Video banner section updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
