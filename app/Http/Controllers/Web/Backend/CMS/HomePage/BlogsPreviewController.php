<?php

namespace App\Http\Controllers\Web\Backend\CMS\HomePage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogsPreview;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class BlogsPreviewController extends Controller {
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
                $data = Blog::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('description', function ($data) {
                        $description      = $data->description;
                        $shortDescription = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                        return '<p>' . $shortDescription . '</p>';
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
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-blog" data-id="' . $data->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showBlogDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewBlogModal" title="View">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $data->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size:24px;"></i>
                                </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['description', 'status', 'action'])
                    ->make();
            }
            $blogsPreview = BlogsPreview::firstOrNew();
            return view('backend.layouts.cms.home-page.blogs-preview.index', compact('blogsPreview'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the blogs preview section.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function updateBlogsPreview(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $blogsPreview = BlogsPreview::firstOrNew();

            $blogsPreview->title       = $request->title;
            $blogsPreview->description = $request->description;
            $blogsPreview->save();

            return redirect()->route('cms.home-page.blogs-preview.index')->with('t-success', 'Blogs preview updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function showBlog(int $id): JsonResponse {
        try {
            $data = Blog::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeBlog(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $blog = Blog::create($request->only(['title', 'description']));

            return Helper::jsonResponse(true, 'Blog created successfully.', 201, $blog);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error creating blog: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified blog in storage.
     *
     * @param  Request  $request
     * @param  int      $id
     * @return JsonResponse
     */
    public function updateBlog(Request $request, int $id): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $blog = Blog::findOrFail($id);
            $blog->update($request->only(['title', 'description']));

            return Helper::jsonResponse(true, 'Blog updated successfully.', 200, $blog);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error updating blog: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Change the status of the specified blog.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function status(int $id): JsonResponse {
        try {
            $blog = Blog::findOrFail($id);

            if ($blog->status === 'active') {
                $blog->status = 'inactive';
                $blog->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $blog);
            } else {
                $blog->status = 'active';
                $blog->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $blog);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified blog from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse {
        try {
            $blog = Blog::findOrFail($id);

            // Delete the record
            $blog->delete();

            return Helper::jsonResponse(true, 'Deleted successfully.', 200, $blog);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while deleting.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
