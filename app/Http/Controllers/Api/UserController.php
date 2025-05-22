<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StorePortfolioProjectRequest;
use App\Http\Requests\Api\User\UpdatePasswordRequest;
use App\Http\Requests\Api\User\UpdateProfileRequest;
use App\Http\Resources\Api\User\PortfolioResource;
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
     * Update the authenticated user's profile information.
     *
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse {
        try {
            $user = $request->user();

            // Extract user data
            $userData = $request->only([
                'first_name',
                'last_name',
            ]);

            // Extract profile data
            $profileData = $request->only([
                'working_role',
                'country',
                'bio',
            ]);

            // Get avatar file if uploaded
            $avatar = $request->hasFile('avatar') ? $request->file('avatar') : null;

            // Update user and profile via service
            $updatedUser = $this->userService->updateUserProfile($user, $userData, $profileData, $avatar);

            return Helper::jsonResponse(true, 'Profile updated successfully', 200, new UserResource($updatedUser));

        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created portfolio project in storage.
     *
     * @param StorePortfolioProjectRequest $request
     * @return JsonResponse
     */
    public function uploadPortfolioProject(StorePortfolioProjectRequest $request): JsonResponse {
        try {
            $user        = $request->user();
            $projectFile = $request->file('project_file');

            $portfolio = $this->userService->storePortfolioProject($user, $projectFile);

            return Helper::jsonResponse(true, 'Portfolio project stored successfully.', 201, new PortfolioResource($portfolio));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified portfolio item.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function deletePortfolioProject(Request $request, int $id): JsonResponse {
        try {
            $user = $request->user();

            // Make sure user is a sales professional
            if ($user->role !== 'sales_professional') {
                return Helper::jsonResponse(false, 'Only sales professionals can delete portfolios.', 403);
            }

            $this->userService->deletePortfolioProject($user, $id);

            return Helper::jsonResponse(true, 'Portfolio project deleted successfully.', 200);
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
