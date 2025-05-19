<?php

namespace App\Http\Controllers\Web\Backend\CMS\ConsultingPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SalesEvaluation;
use App\Models\SalesEvaluationBanner;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SalesEvaluationController extends Controller {
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
                $data = SalesEvaluation::latest()->get();
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
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-sales-evaluation" data-id="' . $data->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showSalesEvaluationDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewSalesEvaluationModal" title="View">
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
            $salesEvaluationBanner = SalesEvaluationBanner::firstOrNew();
            return view('backend.layouts.cms.consulting-page.sales-evaluation.index', compact('salesEvaluationBanner'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update Sales Evaluation Banner.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function updateSalesEvaluationBanner(Request $request): RedirectResponse {
        try {
            $salesEvaluationBanner = SalesEvaluationBanner::firstOrNew();

            $rules = [
                'title'        => 'required|string',
                'image'        => $salesEvaluationBanner->exists
                ? 'nullable|image|mimes:jpg,jpeg,png,gif|max:20480'
                : 'required|image|mimes:jpg,jpeg,png,gif|max:20480',
                'remove_image' => 'nullable|boolean',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $salesEvaluationBanner->title = $request->title;

            //* Handle image file
            if ($request->boolean('remove_image')) {
                if ($salesEvaluationBanner->image) {
                    Helper::fileDelete(public_path($salesEvaluationBanner->image));
                    $salesEvaluationBanner->image = null;
                }
            } elseif ($request->hasFile('image')) {
                if ($salesEvaluationBanner->image) {
                    Helper::fileDelete(public_path($salesEvaluationBanner->image));
                }
                $salesEvaluationBanner->image = Helper::fileUpload($request->file('image'), 'salesEvaluationBanner', $salesEvaluationBanner->image);
            }
            $salesEvaluationBanner->save();

            return redirect()->route('cms.consulting-page.sales-evaluation.index')
                ->with('t-success', 'Sales Evaluation Banner Updated Successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Show the sales evaluation details.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function show(int $id): JsonResponse {
        try {
            $data = SalesEvaluation::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created sales evaluation in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $salesEvaluation              = new SalesEvaluation();
            $salesEvaluation->title       = $request->title;
            $salesEvaluation->description = $request->description;
            $salesEvaluation->save();

            return Helper::jsonResponse(true, 'Sales evaluation created successfully.', 201, $salesEvaluation);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error creating feature: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified sales evaluation in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, int $id): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $salesEvaluation              = SalesEvaluation::findOrFail($id);
            $salesEvaluation->title       = $request->title;
            $salesEvaluation->description = $request->description;
            $salesEvaluation->save();

            return Helper::jsonResponse(true, 'Sales evaluation updated successfully.', 200, $salesEvaluation);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error updating sales evaluation: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Change the status of the specified feature.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function status(int $id): JsonResponse {
        try {
            $salesEvaluation = SalesEvaluation::findOrFail($id);

            if ($salesEvaluation->status === 'active') {
                $salesEvaluation->status = 'inactive';
                $salesEvaluation->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $salesEvaluation);
            } else {
                $salesEvaluation->status = 'active';
                $salesEvaluation->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $salesEvaluation);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified feature from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse {
        try {
            $salesEvaluation = SalesEvaluation::findOrFail($id);

            $salesEvaluation->delete();

            return Helper::jsonResponse(true, 'Deleted successfully.', 200, $salesEvaluation);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while deleting.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
