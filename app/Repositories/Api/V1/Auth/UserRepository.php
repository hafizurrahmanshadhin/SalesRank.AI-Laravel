<?php

namespace App\Repositories\Api\V1\Auth;

use App\Interfaces\Api\V1\Auth\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface {
    /**
     * Summary of createUser
     * @param array $credentials
     * @param int $role
     * @return User
     */
    public function createUser(array $credentials, int $role): User {
        try {
            $user = User::create([
                'first_name'        => $credentials['first_name'],
                'last_name'         => $credentials['last_name'],
                'handle'            => $credentials['handle'],
                'email'             => $credentials['email'],
                'password'          => Hash::make($credentials['password']),
                'email_verified_at' => now(),
                'role_id'           => $role,
            ]);

            $user->profile()->create([
                'phone_number'            => $credentials['phone_number'],
                'linkedin_profile_url'    => $credentials['linkedin_profile_url'] ?? null,
                'revenue_generated_year'  => $credentials['revenue_generated_year'] ?? null,
                'revenue_generated'       => $credentials['revenue_generated'] ?? null,
                'industry_experience'     => $credentials['industry_experience'] ?? null,
                'present_club_experience' => $credentials['present_club_experience'] ?? null,
                'lead_close_ratio'        => $credentials['lead_close_ratio'] ?? null,
            ]);

            return $user;
        } catch (Exception $e) {
            Log::error('UserRepository::createUser', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Attempts to retrieve a user by their email address.
     *
     * This method checks the provided credentials and returns the corresponding user.
     *
     * @param array $credentials The user's login credentials (email and password).
     *
     * @return User|null The user object if found, null otherwise.
     *
     * @throws Exception If there is an error during the query.
     */
    public function login(array $credentials): User | null {
        try {
            return User::where('email', $credentials['email'])->first();
        } catch (Exception $e) {
            Log::error('UserRepository::login', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Find a user by their email address.
     *
     * @param  string     $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User {
        try {
            return User::where('email', $email)->first();
        } catch (Exception $e) {
            Log::error('UserRepository::findByEmail', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
