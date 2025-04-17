<?php

namespace App\Services\Api\V1\Auth;

use App\Interfaces\Api\V1\Auth\PasswordResetRepositoryInterface;
use App\Interfaces\Api\V1\Auth\UserRepositoryInterface;
use App\Mail\ResetPasswordMail;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PasswordResetService {
    public function __construct(
        protected PasswordResetRepositoryInterface $resetRepo,
        protected UserRepositoryInterface $userRepo
    ) {}

    /**
     * Send a password reset link to the given email.
     *
     * @param string $email
     * @return string The reset link
     * @throws Exception If any error occurs in the process
     */
    public function sendResetLink(string $email): string {
        try {
            $user = $this->userRepo->findByEmail($email);
            if (!$user) {
                throw new Exception('Email not found.', 404);
            }

            $token = $this->resetRepo->createToken($email);
            $link  = url("/reset-password?token={$token}&email=" . urlencode($email));

            Mail::to($email)->send(new ResetPasswordMail($link));

            return $link;
        } catch (Exception $e) {
            Log::error('PasswordResetService::sendResetLink', ['error' => $e->getMessage()]);
            throw new Exception('Failed to send password reset link.', $e->getCode() ?: 500);
        }
    }

    /**
     * Reset the user's password using the provided token.
     *
     * @param string $token
     * @param string $newPassword
     * @return void
     * @throws Exception If token invalid/expired or user not found
     */
    public function resetPassword(string $token, string $newPassword): void {
        try {
            $record = $this->resetRepo->getByToken($token);
            if (!$record) {
                throw new Exception('Invalid or expired token.', 404);
            }

            $user = $this->userRepo->findByEmail($record->email);
            if (!$user) {
                throw new Exception('User not found.', 404);
            }

            $user->password = Hash::make($newPassword);
            $user->save();

            $this->resetRepo->deleteByEmail($record->email);
        } catch (Exception $e) {
            Log::error('PasswordResetService::resetPassword', ['error' => $e->getMessage()]);
            throw new Exception('Failed to reset password.', $e->getCode() ?: 500);
        }
    }
}
