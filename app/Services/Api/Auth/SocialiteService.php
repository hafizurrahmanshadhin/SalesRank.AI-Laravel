<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialiteService {
    /**
     * Handle socialite login or registration.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function loginOrRegister(array $data): array {
        DB::beginTransaction();

        try {
            // Fetch social user
            $socialUser = Socialite::driver($data['provider'])->stateless()->userFromToken($data['token']);

            if (!$email = $socialUser->getEmail()) {
                throw new Exception('No email returned from provider');
            }

            // Check for existing user
            $user      = User::where('google_id', $socialUser->getId())->orWhere('email', $email)->first();
            $isNewUser = false;

            // If user not found, validate and create a new user
            if (!$user) {
                $isNewUser = true;
                $this->validateRegistrationData($data, $isNewUser);
                $user = $this->createUser($socialUser, $data);
            }

            // Log the user in, generate a JWT token, and load profile
            Auth::login($user);
            $token = JWTAuth::fromUser($user);
            $user->load('profile');

            DB::commit();

            return [
                'user'      => $user,
                'token'     => $token,
                'isNewUser' => $isNewUser,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Validate registration data.
     *
     * @param array $data
     * @param bool  $isNewUser
     * @throws Exception
     */
    private function validateRegistrationData(array $data, bool $isNewUser): void {
        $rules = [
            'role'                    => $isNewUser ? 'required|in:sales_professional,hiring_company' : 'nullable',
            'phone_number'            => 'nullable|string|unique:profiles,phone_number',
            'linkedin_profile_url'    => 'nullable|url',
            'revenue_generated_year'  => 'nullable|integer',
            'revenue_generated'       => 'nullable|numeric',
            'industry_experience'     => 'nullable|numeric',
            'present_club_experience' => 'nullable|numeric',
            'lead_close_ratio'        => 'nullable|numeric',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }
    }

    /**
     * Create a new user.
     *
     * @param $socialUser
     * @param array $data
     * @return User
     */
    private function createUser($socialUser, array $data) {
        $fullName     = $socialUser->getName() ?? 'user';
        $baseUserName = Str::of($fullName)->replace(' ', '')->lower();
        $userName     = $baseUserName;
        $counter      = 1;
        while (User::where('user_name', $userName)->exists()) {
            $userName = $baseUserName . '_' . $counter++;
        }

        $user = User::create([
            'role'              => $data['role'],
            'first_name'        => $socialUser->user['given_name'] ?? null,
            'last_name'         => $socialUser->user['family_name'] ?? null,
            'user_name'         => $userName,
            'email'             => $socialUser->getEmail(),
            'email_verified_at' => ($socialUser->user['email_verified'] ?? false) ? now() : null,
            'avatar'            => $socialUser->getAvatar(),
            'google_id'         => $socialUser->getId(),
            'password'          => bcrypt(Str::random(16)),
        ]);

        $user->profile()->create([
            'phone_number'            => $data['phone_number'] ?? null,
            'linkedin_profile_url'    => $data['linkedin_profile_url'] ?? null,
            'revenue_generated_year'  => $data['revenue_generated_year'] ?? null,
            'revenue_generated'       => $data['revenue_generated'] ?? null,
            'industry_experience'     => $data['industry_experience'] ?? null,
            'present_club_experience' => $data['present_club_experience'] ?? null,
            'lead_close_ratio'        => $data['lead_close_ratio'] ?? null,
        ]);

        return $user;
    }
}
