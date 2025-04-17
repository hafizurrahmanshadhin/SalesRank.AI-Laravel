<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\V1\Auth\ResetPasswordRequest;
use App\Services\Api\V1\Auth\PasswordResetService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller {
    public function __construct(
        protected PasswordResetService $service
    ) {}

    /**
     * Send a password reset link to the user's email.
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse {
        try {
            $link = $this->service->sendResetLink(
                $request->validated()['email']
            );

            return $this->success(200, 'Password reset link sent.', ['reset_link' => $link]);
        } catch (Exception $e) {
            Log::error('PasswordResetController::forgotPassword', ['error' => $e->getMessage()]);
            return $this->error($e->getCode() ?: 500, $e->getMessage());
        }
    }

    /**
     * Reset the password for a user using a token.
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse {
        try {
            $data = $request->validated();
            $this->service->resetPassword(
                $data['token'],
                $data['password']
            );

            return $this->success(200, 'Password updated successfully.');
        } catch (Exception $e) {
            Log::error('PasswordResetController::resetPassword', ['error' => $e->getMessage()]);
            return $this->error($e->getCode() ?: 500, $e->getMessage());
        }
    }
}
