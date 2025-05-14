<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller {
    /**
     * Display a listing of the testimonials.
     *
     * @param Request $request
     * @return JsonResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | View {
        try {
            if ($request->ajax()) {
                $data = Testimonial::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('description', function ($data) {
                        $description      = $data->description;
                        $shortDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                        return '<p>' . $shortDescription . '</p>';
                    })
                    ->addColumn('image', function ($data) {
                        $defaultImage = asset('backend/images/users/user-dummy-img.jpg');
                        $url          = $data->image ? asset($data->image) : $defaultImage;

                        return '
                            <div class="d-flex justify-content-center">
                                <img src="' . $url . '" alt="Image" width="50" height="50" style="cursor:pointer;"
                                     data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                     onclick="showImagePreview(\'' . $url . '\');" />
                            </div>
                        ';
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
                                <a href="' . route('cms.testimonials.edit', ['id' => $data->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showTestimonialDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal" title="View">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $data->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['description', 'image', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.cms.testimonials.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        try {
            $data = Testimonial::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new testimonials.
     *
     * @return JsonResponse|View
     */
    public function create(): JsonResponse | View {
        try {
            return view('backend.layouts.cms.testimonials.create');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created testimonials in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'name'        => 'required|string',
                'title'       => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $testimonials              = new Testimonial();
            $testimonials->name        = $request->name;
            $testimonials->title       = $request->title;
            $testimonials->description = $request->description;

            // If an image was uploaded, store it
            if ($request->hasFile('image')) {
                $uploadPath = Helper::fileUpload($request->file('image'), 'testimonials', $request->name);
                if ($uploadPath !== null) {
                    $testimonials->image = $uploadPath;
                }
            }

            $testimonials->save();
            return redirect()->route('cms.testimonials.index')->with('t-success', 'Testimonials Create Successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified testimonials.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): JsonResponse | View {
        try {
            $testimonial = Testimonial::findOrFail($id);
            return view('backend.layouts.cms.testimonials.edit', compact('testimonial'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified testimonials in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'name'        => 'required|string',
                'title'       => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $testimonial              = Testimonial::findOrFail($id);
            $testimonial->name        = $request->name;
            $testimonial->title       = $request->title;
            $testimonial->description = $request->description;

            // If a new image is uploaded, delete the old image and upload the new one.
            if ($request->hasFile('image')) {
                if ($testimonial->image) {
                    Helper::fileDelete(public_path($testimonial->image));
                }
                $uploadPath = Helper::fileUpload($request->file('image'), 'testimonials', $request->name);
                if ($uploadPath !== null) {
                    $testimonial->image = $uploadPath;
                }
            }

            $testimonial->save();

            return redirect()->route('cms.testimonials.index')->with('t-success', 'Testimonials updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update testimonial')->withInput();
        }
    }

    /**
     * Change the status of the specified testimonials.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function status(int $id): JsonResponse {
        try {
            $testimonials = Testimonial::findOrFail($id);

            if ($testimonials->status === 'active') {
                $testimonials->status = 'inactive';
                $testimonials->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $testimonials);
            } else {
                $testimonials->status = 'active';
                $testimonials->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $testimonials);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified testimonials from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse {
        try {
            $testimonials = Testimonial::findOrFail($id);

            // If there's an associated image, remove it from storage first
            if ($testimonials->image) {
                $imagePath = public_path($testimonials->image);
                Helper::fileDelete($imagePath);
            }

            // Delete the record
            $testimonials->delete();

            return Helper::jsonResponse(true, 'Deleted successfully.', 200, $testimonials);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while deleting.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
