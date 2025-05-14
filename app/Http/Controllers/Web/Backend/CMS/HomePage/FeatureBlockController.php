<?php

namespace App\Http\Controllers\Web\Backend\CMS\HomePage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FeatureBlock;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class FeatureBlockController extends Controller {
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
                $data = FeatureBlock::latest()->get();
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
                        return '
                            <div class="d-flex justify-content-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">
                                </div>
                            </div>
                        ';
                    })
                    ->addColumn('action', function ($row) {
                        $editUrl = route('cms.home-page.feature-blocks.edit', $row->id);
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
            return view('backend.layouts.cms.home-page.feature-blocks.index');
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
            $categories = FeatureBlock::pluck('category');
            return view('backend.layouts.cms.home-page.feature-blocks.create', compact('categories'));
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
                $alreadyExists = FeatureBlock::where('category', $request->category_name)->exists();
                if ($alreadyExists) {
                    return back()->withErrors([
                        'category_name' => 'This category already exists. Please select it from the dropdown.',
                    ])->withInput();
                }
            }

            // Use either new category name or existing one
            $categoryName = $request->category_name ?: $request->existing_category;

            // Retrieve or create this category
            $featureBlocks = FeatureBlock::where('category', $categoryName)->first();
            if (!$featureBlocks) {
                $featureBlocks           = new FeatureBlock();
                $featureBlocks->category = $categoryName;
                $featureBlocks->images   = [];
            }

            $storedImages = $featureBlocks->images ?: [];

            // Store each new uploaded image path
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $uploadedImage) {
                    $imagePath      = Helper::fileUpload($uploadedImage, 'featureBlocksCategory', null);
                    $storedImages[] = $imagePath;
                }
            }

            $featureBlocks->images = $storedImages;
            $featureBlocks->save();

            return redirect()->route('cms.home-page.feature-blocks.index')->with('t-success', 'Feature blocks created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse|View
     */
    public function edit(int $id): JsonResponse | View {
        try {
            $featureBlocks = FeatureBlock::findOrFail($id);
            $categories    = FeatureBlock::pluck('category');
            return view('backend.layouts.cms.home-page.feature-blocks.edit', compact('featureBlocks', 'categories'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse {
        try {
            $featureBlocks = FeatureBlock::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'images.*' => 'nullable|image|max:20480',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Ensure $removedPaths is always an array
            $removedPaths = json_decode($request->input('removed_images', '[]'), true);
            if (!is_array($removedPaths)) {
                $removedPaths = [];
            }

            // Delete each removed file from storage
            if (count($removedPaths) > 0) {
                foreach ($removedPaths as $pathToDelete) {
                    Helper::fileDelete(public_path($pathToDelete));
                }
            }

            $storedImages = $featureBlocks->images ?: [];
            $storedImages = array_filter($storedImages, function ($img) use ($removedPaths) {
                return !in_array($img, $removedPaths);
            });

            // Add newly uploaded images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $uploadedImage) {
                    $imagePath      = Helper::fileUpload($uploadedImage, 'featureBlocksCategory', null);
                    $storedImages[] = $imagePath;
                }
            }

            $featureBlocks->images = array_values($storedImages);
            $featureBlocks->save();

            return redirect()->route('cms.home-page.feature-blocks.index')->with('t-success', 'Feature blocks updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update')->withInput();
        }
    }

    /**
     * Change the status of the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        try {
            $featureBlocks = FeatureBlock::findOrFail($id);
            if ($featureBlocks->status == 'active') {
                $featureBlocks->status = 'inactive';
                $featureBlocks->save();

                return response()->json([
                    'success' => false,
                    'message' => 'Unpublished Successfully.',
                    'data'    => $featureBlocks,
                ]);
            } else {
                $featureBlocks->status = 'active';
                $featureBlocks->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Published Successfully.',
                    'data'    => $featureBlocks,
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
            $featureBlocks = FeatureBlock::findOrFail($id);

            // Remove images from storage
            if (is_array($featureBlocks->images)) {
                foreach ($featureBlocks->images as $imagePath) {
                    Helper::fileDelete(public_path($imagePath));
                }
            }

            $featureBlocks->delete();

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
