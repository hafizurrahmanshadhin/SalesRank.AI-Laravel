<?php

namespace App\Http\Controllers\Web\Backend\CMS\ConsultingPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\AIPoweredInsights;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AIPoweredInsightsController extends Controller {
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
                $data = AIPoweredInsights::latest()->get();
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
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-data" data-id="' . $data->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDataDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewDataModal" title="View">
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
            return view('backend.layouts.cms.consulting-page.ai-powered-insights.index');
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
    public function show(int $id): JsonResponse {
        try {
            $data = AIPoweredInsights::findOrFail($id);
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
    public function store(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $data = AIPoweredInsights::create($request->only(['title', 'description']));

            return Helper::jsonResponse(true, 'Created successfully.', 201, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error creating: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified data in storage.
     *
     * @param  Request  $request
     * @param  int      $id
     * @return JsonResponse
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

            $data = AIPoweredInsights::findOrFail($id);
            $data->update($request->only(['title', 'description']));

            return Helper::jsonResponse(true, 'Updated successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error updating: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Change the status of the specified ai powered insights.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function status(int $id): JsonResponse {
        try {
            $data = AIPoweredInsights::findOrFail($id);

            if ($data->status === 'active') {
                $data->status = 'inactive';
                $data->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $data);
            } else {
                $data->status = 'active';
                $data->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $data);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified ai powered insights from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = AIPoweredInsights::findOrFail($id);

            $data->delete();

            return Helper::jsonResponse(true, 'Deleted successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while deleting.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
