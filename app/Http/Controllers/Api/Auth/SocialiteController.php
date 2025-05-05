<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialiteController extends Controller {
    public function socialiteLogin(Request $request): JsonResponse {
        // Step 1: Minimal validation to verify token & provider
        $request->validate([
            'token'    => 'required|string',
            'provider' => 'required|string|in:google',
        ]);

        // Step 2: Fetch social user from token
        try {
            $socialUser = Socialite::driver($request->provider)
                ->stateless()
                ->userFromToken($request->token);
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized',
                'code'    => 401,
                'error'   => 'Invalid token or provider',
            ], 401);
        }

        // Step 3: Extract email and try to find an existing user
        $email = $socialUser->getEmail();
        if (!$email) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized',
                'code'    => 401,
                'error'   => 'No email returned from provider',
            ], 401);
        }

        $user = User::where('google_id', $socialUser->getId())
            ->orWhere('email', $email)
            ->first();

        $isNewUser = false;

        // Step 4: If user doesn't exist, validate extra fields and create user + profile
        if (!$user) {
            // Full validation for new users
            $request->validate([
                'role'                    => 'required|in:sales_professional,hiring_company',
                'phone_number'            => 'required|string|unique:profiles,phone_number',
                'linkedin_profile_url'    => 'nullable|url',
                'revenue_generated_year'  => 'nullable|integer',
                'revenue_generated'       => 'nullable|numeric',
                'industry_experience'     => 'nullable|numeric',
                'present_club_experience' => 'nullable|numeric',
                'lead_close_ratio'        => 'nullable|numeric',
            ]);

            // Map social user data
            $givenName  = $socialUser->user['given_name'] ?? null;
            $familyName = $socialUser->user['family_name'] ?? null;
            $fullName   = $socialUser->getName() ?? 'user';

            $baseUserName = Str::of($fullName)->replace(' ', '')->lower()->__toString();
            // Ensure uniqueness
            $userName = $baseUserName;
            $count    = 1;
            while (User::where('user_name', $userName)->exists()) {
                $userName = $baseUserName . '_' . $count;
                $count++;
            }

            $avatarUrl     = $socialUser->getAvatar() ?? null;
            $emailVerified = $socialUser->user['email_verified'] ?? false;

            // Create user
            $user = User::create([
                'role'              => $request->input('role'),
                'first_name'        => $givenName,
                'last_name'         => $familyName,
                'user_name'         => $userName,
                'email'             => $email,
                'email_verified_at' => $emailVerified ? now() : null,
                'avatar'            => $avatarUrl,
                'google_id'         => $socialUser->getId(),
                'password'          => bcrypt(Str::random(16)),
            ]);

            $isNewUser = true;

            // Create profile
            $user->profile()->create([
                'phone_number'            => $request->input('phone_number'),
                'linkedin_profile_url'    => $request->input('linkedin_profile_url'),
                'revenue_generated_year'  => $request->input('revenue_generated_year'),
                'revenue_generated'       => $request->input('revenue_generated'),
                'industry_experience'     => $request->input('industry_experience'),
                'present_club_experience' => $request->input('present_club_experience'),
                'lead_close_ratio'        => $request->input('lead_close_ratio'),
            ]);
        }

        // Step 5: Log in and issue token
        Auth::login($user);
        $jwtToken = JWTAuth::fromUser($user);
        $user->load('profile');

        // Step 6: Prepare response
        $profile      = $user->profile;
        $responseUser = [
            'id'                      => $user->id,
            'first_name'              => $user->first_name,
            'last_name'               => $user->last_name,
            'user_name'               => $user->user_name,
            'email'                   => $user->email,
            'role'                    => $user->role,
            'phone_number'            => $profile->phone_number ?? null,
            'linkedin_profile_url'    => $profile->linkedin_profile_url ?? null,
            'revenue_generated_year'  => $profile->revenue_generated_year ?? null,
            'revenue_generated'       => $profile->revenue_generated ?? null,
            'industry_experience'     => $profile->industry_experience ?? null,
            'present_club_experience' => $profile->present_club_experience ?? null,
            'lead_close_ratio'        => $profile->lead_close_ratio ?? null,
            'avatar'                  => $user->avatar,
        ];

        return response()->json([
            'status'  => true,
            'message' => $isNewUser
            ? 'User registered successfully'
            : 'User logged in successfully',
            'code'    => 200,
            'data'    => [
                'token'  => $jwtToken,
                'verify' => !empty($user->email_verified_at),
                'user'   => $responseUser,
            ],
        ], 200);
    }
}
