<?php

namespace App\Http\Controllers\Api\AI;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AI\ConsultantDetailResource;
use App\Http\Resources\Api\AI\ConsultantResource;
use App\Models\Consultant;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConsultantController extends Controller {
    /**
     * Display a listing of the consultants with optional filters.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse {
        try {
            $query = Consultant::with('user.profile', 'user.portfolios');

            // Filter by department (in user.profile.working_role)
            if ($request->filled('department')) {
                $query->whereHas('user.profile', function ($q) use ($request) {
                    $q->where('working_role', 'like', '%' . $request->department . '%');
                });
            }

            // Filter by position (in consultant.job_title)
            if ($request->filled('position')) {
                $query->where('job_title', 'like', '%' . $request->position . '%');
            }

            // Filter by years_of_experience (use exact match or adjust if needed)
            if ($request->filled('years_of_experience')) {
                $query->where('total_experience', $request->years_of_experience);
            }

            // Filter by location (allow partial match)
            if ($request->filled('location')) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            $data = $query->latest()->get();

            return Helper::jsonResponse(true, 'Data fetched successfully', 200, ConsultantResource::collection($data));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Search consultants by name.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function searchByName(Request $request): JsonResponse {
        try {
            $searchTerm = $request->input('name');

            $query = Consultant::with('user.profile', 'user.portfolios')
                ->where(function ($consultantQuery) use ($searchTerm) {
                    // Match consultant’s own full_name if user doesn't exist
                    $consultantQuery->where('full_name', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                    // Match user’s first name or last name
                    $userQuery->where('first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
                });

            $data = $query->get();

            return Helper::jsonResponse(true, 'Data fetched successfully', 200, ConsultantResource::collection($data));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function show($id): JsonResponse {
        try {
            $consultant = Consultant::with('user.profile', 'user.portfolios')->findOrFail($id);

            return Helper::jsonResponse(true, 'Data fetched successfully', 200, new ConsultantDetailResource($consultant));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
