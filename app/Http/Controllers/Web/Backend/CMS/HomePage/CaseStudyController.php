<?php

namespace App\Http\Controllers\Web\Backend\CMS\HomePage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CaseStudyController extends Controller {
    /**
     * Display a listing of the Case Studies.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = CaseStudy::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function ($row) {
                        return $row->category;
                    })
                    ->addColumn('images', function ($row) {
                        $html = '';
                        if ($row->images && is_array($row->images)) {
                            foreach ($row->images as $img) {
                                $fullPath = asset($img);
                                $html .= '<img src="' . $fullPath . '" alt="img" class="img-previewable" data-full="' . $fullPath . '"
                                            style="cursor:pointer; max-width:60px; max-height:60px; object-fit:cover; border-radius:4px; margin-right:5px;" >';
                            }
                        }
                        return $html;
                    })
                    ->addColumn('status', function ($data) {
                        $status = '<div class="form-check form-switch" style="margin-left: 20px; width: 50px; height: 24px;">';
                        $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">';
                        $status .= '</div>';

                        return $status;
                    })
                    ->addColumn('action', function ($row) {
                        $editUrl = route('cms.home-page.case-studies.edit', $row->id);
                        return '
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="' . $editUrl . '" class="btn btn-sm btn-info me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $row->id . ')"
                                   class="btn btn-sm btn-danger" title="Delete">
                                    <i class="bi bi-trash3"></i> Delete
                                </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['category', 'images', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.cms.home-page.case-studies.index');
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
            $categories = CaseStudy::pluck('category');
            return view('backend.layouts.cms.home-page.case-studies.create', compact('categories'));
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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'category_name'     => 'required_without:existing_category|nullable|string',
                'existing_category' => 'required_without:category_name|nullable|string',
                'images'            => 'required|max:20480', // force user to upload at least one image
                'images.*'          => 'image|max:20480',
            ], [
                'images.required' => 'Please select at least one image to upload.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // If user typed a new category, ensure it doesn't already exist
            if ($request->filled('category_name')) {
                $alreadyExists = CaseStudy::where('category', $request->category_name)->exists();
                if ($alreadyExists) {
                    return back()->withErrors([
                        'category_name' => 'This category already exists. Please select it from the dropdown.',
                    ])->withInput();
                }
            }

            // Use either new category name or existing one
            $categoryName = $request->category_name ?: $request->existing_category;

            // Retrieve or create this category
            $caseStudy = CaseStudy::where('category', $categoryName)->first();
            if (!$caseStudy) {
                $caseStudy           = new CaseStudy();
                $caseStudy->category = $categoryName;
                $caseStudy->images   = [];
            }

            $storedImages = $caseStudy->images ?: [];

            // Store each new uploaded image path
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $uploadedImage) {
                    $imagePath      = Helper::fileUpload($uploadedImage, 'caseStudiesCategory', null);
                    $storedImages[] = $imagePath;
                }
            }

            $caseStudy->images = $storedImages;
            $caseStudy->save();

            return redirect()->route('cms.home-page.case-studies.index')->with('t-success', 'Case Study created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    public function edit($id) {
        $caseStudy  = CaseStudy::findOrFail($id);
        $categories = CaseStudy::pluck('category');
        return view('backend.layouts.cms.home-page.case-studies.edit', compact('caseStudy', 'categories'));
    }

    public function update($id, Request $request) {
        $caseStudy = CaseStudy::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'category_name'     => 'nullable|string',
            'existing_category' => 'nullable|string',
            'images.*'          => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Use new category name or existing one
        $categoryName = $request->category_name ?: $request->existing_category;
        if (empty($categoryName)) {
            return back()->with('t-error', 'Please enter or select a category.')->withInput();
        }

        // If category is changed, we need to confirm it's unique
        if ($caseStudy->category !== $categoryName) {
            $exists = CaseStudy::where('category', $categoryName)->first();
            if ($exists) {
                return back()->with('t-error', 'Category name already in use, please select or create another.')->withInput();
            }
        }
        // Update category
        $caseStudy->category = $categoryName;

        // Handle images
        $storedImages = $caseStudy->images ?: [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $uploadedImage) {
                $imagePath      = Helper::fileUpload($uploadedImage, 'caseStudiesCategory', null);
                $storedImages[] = $imagePath;
            }
        }
        $caseStudy->images = $storedImages;
        $caseStudy->save();

        return redirect()->route('cms.home-page.case-studies.index')
            ->with('t-success', 'Case Study updated successfully!');
    }

    /**
     * Change the status of the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        try {
            $data = CaseStudy::findOrFail($id);
            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();

                return response()->json([
                    'success' => false,
                    'message' => 'Unpublished Successfully.',
                    'data'    => $data,
                ]);
            } else {
                $data->status = 'active';
                $data->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Published Successfully.',
                    'data'    => $data,
                ]);
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
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = CaseStudy::findOrFail($id);

            // Remove images from storage
            if (is_array($data->images)) {
                foreach ($data->images as $imagePath) {
                    Helper::fileDelete(public_path($imagePath));
                }
            }

            $data->delete();

            return response()->json([
                't-success' => false,
                'message'   => 'Deleted successfully.',
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
