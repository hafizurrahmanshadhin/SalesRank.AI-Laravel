<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService {
    /**
     * Login the user and return the token and user data.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function login(array $data): array {
        try {
            $token = JWTAuth::attempt([
                'email'    => $data['email'],
                'password' => $data['password'],
            ]);

            if (!$token) {
                throw new Exception('Unauthorized');
            }

            $user = auth()->user();
            $user->load('profile');

            return [
                'user'  => $user,
                'token' => $token,
            ];
        } catch (Exception $e) {
            throw $e;
        }
    }
}
