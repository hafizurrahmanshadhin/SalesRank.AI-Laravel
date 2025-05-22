<?php

namespace App\Services\Api;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService {
    /**
     * Get the authenticated user with profile and portfolios.
     *
     * @param User $user
     * @return User
     * @throws Exception
     */
    public function getAuthenticatedUserData(User $user): User {
        try {
            return $user->load(['profile', 'portfolios']);
        } catch (ModelNotFoundException $e) {
            Log::warning('User not found when loading profile and portfolios.', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);
            throw new Exception('User data not found.');
        } catch (Exception $e) {
            Log::error('Unexpected error loading user data.', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Verify current password & update to the new password.
     *
     * @param User   $user
     * @param string $currentPassword
     * @param string $newPassword
     * @throws Exception
     */
    public function updatePassword(User $user, string $currentPassword, string $newPassword): void {
        try {
            // Check current password
            if (!Hash::check($currentPassword, $user->password)) {
                throw new Exception('Current password does not match.', 400);
            }

            // Update to new password
            $user->password = Hash::make($newPassword);
            $user->save();

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
