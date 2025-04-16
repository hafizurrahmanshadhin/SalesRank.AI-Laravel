<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\V1\Auth\ResetPasswordRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller {
    /**
     * Send a password reset link to the user's email.
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse {
        try {
            $email = $request->validated()['email'];
            $user  = User::where('email', $email)->first();

            if (!$user) {
                return $this->error(404, 'Email not found.');
            }

            // Create or update a password reset token
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                [
                    'token'      => Str::random(60),
                    'created_at' => Carbon::now(),
                ]
            );

            // Retrieve the new token
            $token     = DB::table('password_reset_tokens')->where('email', $email)->value('token');
            $resetLink = url('/reset-password?token=' . $token);

            // Send the reset link by email
            Mail::to($email)->send(new ResetPasswordMail($resetLink));

            return $this->success(200, 'Password reset link sent.', [
                'reset_link' => $resetLink,
            ]);
        } catch (Exception $e) {
            Log::error('PasswordResetController::forgotPassword', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error');
        }
    }

    /**
     * Reset the user's password.
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse {
        try {
            $validated = $request->validated();
            $token     = $validated['token'];

            // Get the reset record
            $reset = DB::table('password_reset_tokens')->where('token', $token)->first();
            if (!$reset) {
                return $this->error(404, 'Invalid or expired token.');
            }

            // Token older than 60 minutes => invalid
            if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
                return $this->error(400, 'Token has expired.');
            }

            // Get the user and update password
            $user = User::where('email', $reset->email)->first();
            if (!$user) {
                return $this->error(404, 'User not found.');
            }

            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            // Optionally remove token from table
            DB::table('password_reset_tokens')->where('email', $reset->email)->delete();

            return $this->success(200, 'Password updated successfully.');
        } catch (Exception $e) {
            Log::error('PasswordResetController::resetPassword', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error');
        }
    }
}
