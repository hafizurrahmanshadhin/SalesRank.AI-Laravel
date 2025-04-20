<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller {
    public function socialiteLogin(Request $request): JsonResponse {
        $request->validate([
            'token'    => 'required',
            'provider' => 'required|in:google',
        ]);

        try {
            $token    = $request->token;
            $provider = $request->provider;

            // Fetch the social user info using the token
            $socialUser = Socialite::driver($provider)->stateless()->userFromToken($token);

            if ($socialUser) {
                // Check if the user exists in the database
                $user      = User::where('email', $socialUser->email)->first();
                $isNewUser = false;

                if (!$user) {
                    // If user doesn't exist, create a new one
                    $password   = Str::random(16);
                    $handle     = str_replace(' ', '', $socialUser->getName());
                    $givenName  = $socialUser->user['given_name'] ?? null;
                    $familyName = $socialUser->user['family_name'] ?? null;

                    $user = User::create([
                        'first_name'        => $givenName,
                        'last_name'         => $familyName,
                        'handle'            => $handle,
                        'email'             => $socialUser->email,
                        'avatar'            => $socialUser->avatar,
                        'email_verified_at' => now(),
                        'google_id'         => $socialUser->id,
                        'password'          => bcrypt($password),
                    ]);
                    $isNewUser = true;
                }

                // Log the user in
                Auth::login($user);
                $token = $user->createToken('auth_token')->plainTextToken;

                // Prepare the response data
                $responseData = [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ];

                return response()->json([
                    'status'     => true,
                    'message'    => $isNewUser ? 'User registered successfully' : 'User logged in successfully',
                    'code'       => 200,
                    'token_type' => 'bearer',
                    'token'      => $token,
                    'data'       => $responseData,
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Unauthorized',
                    'code'    => 401,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'code'    => 500,
                'error'   => $e->getMessage(),
            ]);
        }
    }

}
