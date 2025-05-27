<?php

namespace App\Services\Api;

use App\Helpers\Helper;
use App\Models\Portfolio;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
     * Update user and profile information.
     *
     * @param User $user
     * @param array $userData
     * @param array $profileData
     * @param UploadedFile|null $avatar
     * @return User
     * @throws Exception
     */
    public function updateUserProfile(User $user, array $userData, array $profileData, ?UploadedFile $avatar = null): User {
        try {
            DB::beginTransaction();

            // Handle avatar upload if provided
            if ($avatar) {
                // Delete old avatar if it exists and isn't a default image
                if ($user->avatar && !str_contains($user->avatar, 'user-dummy-img.jpg')) {
                    // Get the full path of the old file to delete
                    $oldPath = public_path($user->getRawOriginal('avatar'));
                    Helper::fileDelete($oldPath);
                }

                // Upload new avatar using Helper class
                $avatarPath = Helper::fileUpload($avatar, 'avatars', $user->user_name);
                if ($avatarPath) {
                    $userData['avatar'] = $avatarPath;
                }
            }

            // Update user data
            $user->update($userData);

            // Create profile if it doesn't exist, otherwise update it
            if (!$user->profile) {
                $user->profile()->create($profileData);
            } else {
                $user->profile->update($profileData);
            }

            DB::commit();

            // Reload the user with updated profile
            return $this->getAuthenticatedUserData($user);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update profile', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
            throw new Exception('Failed to update profile: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Store a new portfolio project for the user.
     *
     * @param User $user
     * @param UploadedFile $projectFile
     * @return Portfolio
     * @throws Exception
     */
    public function storePortfolioProject(User $user, UploadedFile $projectFile): Portfolio {
        try {
            // Verify user is a sales professional
            if ($user->role !== 'sales_professional') {
                throw new Exception('Only sales professionals can create portfolios.', 403);
            }

            // Upload the project file
            $projectPath = Helper::fileUpload($projectFile, 'portfolioProjects', $user->user_name);

            if (!$projectPath) {
                throw new Exception('Failed to upload the project file.', 500);
            }

            // Create and return the portfolio
            return $user->portfolios()->create([
                'project_path' => $projectPath,
            ]);

        } catch (Exception $e) {
            Log::error('Failed to store portfolio', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Delete a portfolio project permanently.
     *
     * @param User $user
     * @param int $portfolioId
     * @return bool
     * @throws Exception
     */
    public function deletePortfolioProject(User $user, int $portfolioId): bool {
        try {
            // Find the portfolio and verify ownership
            $portfolio = $user->portfolios()->findOrFail($portfolioId);

            // Get the file path to delete
            $filePath = public_path($portfolio->project_path);

            // Delete the file
            Helper::fileDelete($filePath);

            // Permanently delete the portfolio record
            return $portfolio->forceDelete();

        } catch (Exception $e) {
            Log::error('Failed to delete portfolio', [
                'user_id'      => $user->id,
                'portfolio_id' => $portfolioId,
                'error'        => $e->getMessage(),
            ]);
            throw new Exception("Failed to delete portfolio: " . $e->getMessage(), 500);
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

            Auth::logoutOtherDevices($currentPassword);

            // Update to new password
            $user->password = Hash::make($newPassword);
            $user->save();

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
