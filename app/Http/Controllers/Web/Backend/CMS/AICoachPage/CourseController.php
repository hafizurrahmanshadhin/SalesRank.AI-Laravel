<?php

namespace App\Http\Controllers\Web\Backend\CMS\AICoachPage;

use App\Http\Controllers\Controller;
use App\Models\CoursePreview;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller {
    public function index(Request $request) {
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
            $coursePreview = CoursePreview::firstOrNew();
            return view('backend.layouts.cms.ai-coach-page.course.index', compact('coursePreview'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    public function updateCoursePreview(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $coursePreview = CoursePreview::firstOrNew();

            $coursePreview->title       = $request->title;
            $coursePreview->description = $request->description;
            $coursePreview->save();

            return redirect()->route('cms.ai-coach-page.course.index')->with('t-success', 'Course preview updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
