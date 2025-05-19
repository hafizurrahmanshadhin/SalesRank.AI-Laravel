<?php

namespace App\Http\Controllers\Web\Backend\CMS\ConsultingPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\GrowthStory;
use App\Models\GrowthStoryBanner;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class GrowthStoryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | RedirectResponse | View {
        try {
            if ($request->ajax()) {
                $data = GrowthStory::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        $defaultImage = asset('backend/images/users/user-dummy-img.jpg');
                        $url          = $data->image ? asset($data->image) : $defaultImage;

                        return '
                            <div class="d-flex justify-content-center">
                                <img src="' . $url . '" alt="Image" width="75" height="75" style="cursor:pointer;"
                                     data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                     onclick="showImagePreview(\'' . $url . '\');" />
                            </div>
                        ';
                    })
                    ->addColumn('image_url', function ($data) {
                        $defaultImage = asset('backend/images/users/user-dummy-img.jpg');
                        return $data->image ? asset($data->image) : $defaultImage;
                    })
                    ->addColumn('status', function ($data) {
                        return '
                            <div class="d-flex justify-content-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">
                                </div>
                            </div>
                        ';
                    })
                    ->addColumn('action', function ($data) {
                        return '
                            <div class="d-flex justify-content-center hstack gap-3 fs-base">
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-growthStory" data-id="' . $data->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $data->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size:24px;"></i>
                                </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['image', 'image_url', 'status', 'action'])
                    ->make();
            }
            $growthStoryBanner = GrowthStoryBanner::firstOrNew();
            return view('backend.layouts.cms.consulting-page.growth-story-banner.index', compact('growthStoryBanner'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the growth story banner.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function updateGrowthStory(Request $request): RedirectResponse {
        try {
            $growthStoryBanner = GrowthStoryBanner::firstOrNew();

            $rules = [
                'title' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $growthStoryBanner->title = $request->title;
            $growthStoryBanner->save();

            return redirect()->route('cms.consulting-page.growth-story.index')->with('t-success', 'Growth Story Banner Updated Successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $growthStory        = new GrowthStory();
            $growthStory->title = $request->title;

            // If an image was uploaded, store it
            if ($request->hasFile('image')) {
                $uploadPath = Helper::fileUpload($request->file('image'), 'growthStory', $request->title);
                if ($uploadPath !== null) {
                    $growthStory->image = $uploadPath;
                }
            } else {
                $growthStory->image = null;
            }
            $growthStory->save();

            return Helper::jsonResponse(true, 'Growth story created successfully.', 201, $growthStory);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error creating growth story: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, int $id): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $growthStory        = GrowthStory::findOrFail($id);
            $growthStory->title = $request->title;

            // If a new image is uploaded, delete the old image and upload the new one.
            if ($request->hasFile('image')) {
                if (!empty($growthStory->image)) {
                    Helper::fileDelete(public_path($growthStory->image));
                }
                $uploadPath = Helper::fileUpload($request->file('image'), 'growthStory', $request->title);
                if ($uploadPath !== null) {
                    $growthStory->image = $uploadPath;
                }
            }

            $growthStory->save();

            return Helper::jsonResponse(true, 'Growth story updated successfully.', 200, $growthStory);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error updating growth story: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Change the status of the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function status(int $id): JsonResponse {
        try {
            $growthStory = GrowthStory::findOrFail($id);

            if ($growthStory->status === 'active') {
                $growthStory->status = 'inactive';
                $growthStory->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $growthStory);
            } else {
                $growthStory->status = 'active';
                $growthStory->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $growthStory);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse {
        try {
            $growthStory = GrowthStory::findOrFail($id);

            // If there's an associated image, remove it from storage first
            if ($growthStory->image) {
                $imagePath = public_path($growthStory->image);
                Helper::fileDelete($imagePath);
            }

            // Delete the record
            $growthStory->delete();

            return Helper::jsonResponse(true, 'Deleted successfully.', 200, $growthStory);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while deleting.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
