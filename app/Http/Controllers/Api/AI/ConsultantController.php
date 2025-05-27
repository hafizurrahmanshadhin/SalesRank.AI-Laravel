<?php

namespace App\Http\Controllers\Api\AI;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AI\ConsultantResource;
use App\Models\Consultant;
use Illuminate\Http\JsonResponse;

class ConsultantController extends Controller {
    public function index(): JsonResponse {
        $data = Consultant::with('user.profile', 'user.portfolios')->latest()->get();

        return Helper::jsonResponse(true, 'Data fetched successfully', 200, ConsultantResource::collection($data));
    }
}
