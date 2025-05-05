<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Services\Api\Auth\PasswordResetService;
use Exception;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller {
    public function __construct(
        protected PasswordResetService $service
    ) {}

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse {
        try {
            $link = $this->service->sendResetLink($request->validated('email'));

            return Helper::jsonResponse(true, 'Password reset link sent.', 200, $link);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Unable to send reset link.', 500, $e->getMessage());
        }
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse {
        try {
            $email = $request->header('email');

            $this->service->resetPassword(
                $request->validated('token'),
                $request->validated('password'),
                $email
            );

            return Helper::jsonResponse(true, 'Password updated successfully.', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Unable to reset password.', 500, $e->getMessage());
        }
    }
}
