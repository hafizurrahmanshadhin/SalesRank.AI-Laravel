<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdatePasswordRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Services\Api\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller {
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Retrieve the currently authenticated user's full data.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAuthenticatedUser(Request $request): JsonResponse {
        try {
            // Get authenticated user with relationships
            $user = $this->userService->getAuthenticatedUserData($request->user());

            return Helper::jsonResponse(true, 'Authenticated user data fetched successfully.', 200, new UserResource($user));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the authenticated user's password.
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse {
        try {
            $user = $request->user();

            // logic delegated to the service
            $this->userService->updatePassword($user, $request->current_password, $request->new_password);

            return Helper::jsonResponse(true, 'Password updated successfully.', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
