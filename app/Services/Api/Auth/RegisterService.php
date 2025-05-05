<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterService {
    /**
     * Register a new user and create a profile.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function register(array $data): array {
        $existingUser = User::where('email', $data['email'])->exists();
        if ($existingUser) {
            throw new Exception('The email has already been taken.');
        }

        try {
            // Create user with role
            $user = User::create([
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'user_name'         => $data['user_name'],
                'email'             => $data['email'],
                'email_verified_at' => now(),
                'password'          => bcrypt($data['password']),
                'role'              => $data['role'],
            ]);

            // Create profile
            $user->profile()->create([
                'phone_number'            => $data['phone_number'],
                'linkedin_profile_url'    => $data['linkedin_profile_url'] ?? null,
                'revenue_generated_year'  => $data['revenue_generated_year'] ?? null,
                'revenue_generated'       => $data['revenue_generated'] ?? null,
                'industry_experience'     => $data['industry_experience'] ?? null,
                'present_club_experience' => $data['present_club_experience'] ?? null,
                'lead_close_ratio'        => $data['lead_close_ratio'] ?? null,
            ]);

        } catch (Exception $e) {
            throw new Exception('User registration failed: ' . $e->getMessage());
        }

        try {
            $token = JWTAuth::attempt(['email' => $data['email'], 'password' => $data['password']]);
            if (!$token) {
                throw new Exception('Authentication failed.');
            }
        } catch (JWTException $e) {
            throw new Exception('Could not create token: ' . $e->getMessage());
        }

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
