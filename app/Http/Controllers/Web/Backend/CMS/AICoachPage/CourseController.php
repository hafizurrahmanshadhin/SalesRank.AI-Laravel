<?php

namespace App\Http\Controllers\Web\Backend\CMS\AICoachPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePreview;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CourseController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | RedirectResponse | View {
        try {
            if ($request->ajax()) {
                $data = Course::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', function ($data) {
                        $title      = $data->title;
                        $shortTitle = strlen($title) > 100 ? substr($title, 0, 100) . '...' : $title;
                        return '<p>' . $shortTitle . '</p>';
                    })
                    ->addColumn('conduct_by', function ($data) {
                        $conduct_by     = $data->conduct_by;
                        $shortConductBy = strlen($conduct_by) > 100 ? substr($conduct_by, 0, 100) . '...' : $conduct_by;
                        return '<p>' . $shortConductBy . '</p>';
                    })
                    ->editColumn('course_duration', function ($data) {
                        // Return with "Weeks" appended for display
                        return $data->course_duration . ' Weeks';
                    })
                    ->addColumn('description', function ($data) {
                        $description      = $data->description;
                        $shortDescription = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                        return '<p>' . $shortDescription . '</p>';
                    })
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
                                <a href="' . route('cms.ai-coach-page.course.edit', ['id' => $data->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showCourseDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewCourseModal" title="View">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $data->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['title', 'conduct_by', 'course_duration', 'description', 'image', 'status', 'action'])
                    ->make();
            }
            $coursePreview = CoursePreview::firstOrNew();
            return view('backend.layouts.cms.ai-coach-page.course.index', compact('coursePreview'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update or create course preview.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function updateCoursePreview(Request $request): RedirectResponse {
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

    /**
     * Display the specified course.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        try {
            $data = Course::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse|View
     * @throws Exception
     */
    public function create(): JsonResponse | View {
        try {
            return view('backend.layouts.cms.ai-coach-page.course.create');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created course in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'           => 'required|string',
                'description'     => 'required|string',
                'conduct_by'      => 'required|string',
                'course_duration' => 'required|integer|min:1',
                'course_level'    => 'required|in:beginner,intermediate,advanced',
                'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $course                  = new Course();
            $course->title           = $request->title;
            $course->description     = $request->description;
            $course->conduct_by      = $request->conduct_by;
            $course->course_duration = $request->course_duration;
            $course->course_level    = $request->course_level;

            if ($request->hasFile('image')) {
                $uploadPath = Helper::fileUpload($request->file('image'), 'courses', $request->title);
                if ($uploadPath !== null) {
                    $course->image = $uploadPath;
                }
            }

            $course->save();

            return redirect()->route('cms.ai-coach-page.course.index')->with('t-success', 'Course Created Successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to Create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified course.
     *
     * @param  int  $id
     * @return JsonResponse|View
     * @throws Exception
     */
    public function edit(int $id): JsonResponse | View {
        try {
            $course = Course::findOrFail($id);
            return view('backend.layouts.cms.ai-coach-page.course.edit', compact('course'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified course in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'           => 'required|string',
                'description'     => 'required|string',
                'conduct_by'      => 'required|string',
                'course_duration' => 'required|integer|min:1',
                'course_level'    => 'required|in:beginner,intermediate,advanced',
                'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                'remove_image'    => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $course                  = Course::findOrFail($id);
            $course->title           = $request->title;
            $course->description     = $request->description;
            $course->conduct_by      = $request->conduct_by;
            $course->course_duration = $request->course_duration;
            $course->course_level    = $request->course_level;

            //* Handle image
            if ($request->boolean('remove_image')) {
                if ($course->image) {
                    Helper::fileDelete(public_path($course->image));
                    $course->image = null;
                }
            } elseif ($request->hasFile('image')) {
                if ($course->image) {
                    Helper::fileDelete(public_path($course->image));
                }
                $uploadPath = Helper::fileUpload($request->file('image'), 'courses', $request->title);
                if ($uploadPath !== null) {
                    $course->image = $uploadPath;
                }
            }

            $course->save();

            return redirect()->route('cms.ai-coach-page.course.index')->with('t-success', 'Course Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update course')->withInput();
        }
    }

    /**
     * Change the status of the specified course.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function status(int $id): JsonResponse {
        try {
            $course = Course::findOrFail($id);

            if ($course->status === 'active') {
                $course->status = 'inactive';
                $course->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $course);
            } else {
                $course->status = 'active';
                $course->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $course);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified course from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse {
        try {
            $course = Course::findOrFail($id);

            if ($course->image) {
                $imagePath = public_path($course->image);
                Helper::fileDelete($imagePath);
            }
            $course->delete();

            return Helper::jsonResponse(true, 'Deleted successfully.', 200, $course);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while deleting.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
