<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SocialiteRequest;
use App\Http\Resources\Api\Auth\SocialiteResource;
use App\Services\Api\Auth\SocialiteService;
use Illuminate\Http\JsonResponse;

class SocialiteController extends Controller {
    private SocialiteService $socialiteService;
    public function __construct(SocialiteService $socialiteService) {
        $this->socialiteService = $socialiteService;
    }

    /**
     * Handle socialite login or registration.
     *
     * @param SocialiteRequest $request
     * @return JsonResponse
     */
    public function socialiteLogin(SocialiteRequest $request): JsonResponse {
        // only token/provider are “validated”
        $data = $request->validated();

        // add other fields to the data array
        $data = array_merge($data, $request->only([
            'role',
            'phone_number',
            'linkedin_profile_url',
            'revenue_generated_year',
            'revenue_generated',
            'industry_experience',
            'present_club_experience',
            'lead_close_ratio',
        ]));

        $result  = $this->socialiteService->loginOrRegister($data);
        $status  = $result['isNewUser'] ? 201 : 200;
        $message = $result['isNewUser'] ? 'User registered successfully' : 'User logged in successfully';

        return response()->json([
            'status'     => true,
            'message'    => $message,
            'code'       => $status,
            'token_type' => 'bearer',
            'token'      => $result['token'],
            'data'       => new SocialiteResource($result['user']),
        ], $status);
    }
}
