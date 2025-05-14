<?php

namespace App\Http\Controllers\Web\Backend\CMS\HomePage;

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
    // public function index() {
    //     try {
    //         $blogsPreview = BlogsPreview::firstOrNew();
    //         return view('backend.layouts.cms.home-page.blogs-preview.index', compact('blogsPreview'));
    //     } catch (Exception $e) {
    //         return back()->with('t-error', $e->getMessage());
    //     }
    // }
    public function index(Request $request) {
        try {
            if ($request->ajax()) {
                $data = Blog::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('description', function ($data) {
                        $description      = $data->description;
                        $shortDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                        return '<p>' . $shortDescription . '</p>';
                    })
                    ->addColumn('status', function ($service) {
                        $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                        $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $service->id . '" ' . ($service->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $service->id . ')">';
                        $status .= '</div>';
                        return $status;
                    })
                    ->addColumn('action', function ($service) {
                        return '
                            <div class="hstack gap-3 fs-base">
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-service" data-id="' . $service->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $service->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size:24px;"></i>
                                </a>
                            </div>';
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            Blog::create([
                'title'       => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            return response()->json(['success' => true, 'message' => 'Service package created successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while creating the service package: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the blogs preview section.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
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

            $blogsPreview = BlogsPreview::firstOrNew();

            $blogsPreview->title       = $request->title;
            $blogsPreview->description = $request->description;
            $blogsPreview->save();

            return redirect()->route('cms.home-page.blogs-preview.index')->with('t-success', 'Blogs preview updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
