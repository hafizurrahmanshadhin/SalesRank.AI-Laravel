<?php

namespace App\Http\Controllers\Api\AI;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AI\ConsultantResource;
use App\Models\Consultant;

class ConsultantController extends Controller {
    public function index() {
        $consultants = Consultant::with('user')->get();

        return response()->json([
            'success' => true,
            'data'    => ConsultantResource::collection($consultants),
        ]);
    }
}
