<?php

namespace App\Repositories\Api\V1\Auth;

use App\Interfaces\Api\V1\Auth\PasswordResetRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PasswordResetRepository implements PasswordResetRepositoryInterface {
    protected string $table;
    protected int $expires; // in minutes

    public function __construct() {
        // Pull both values from config/auth.php
        $this->table   = config('auth.passwords.users.table');
        $this->expires = config('auth.passwords.users.expire');
    }

    /**
     * Create a new password reset token for the given email.
     *
     * @param string $email
     * @return string The newly created token
     * @throws Exception If any error occurs in the process
     */
    public function createToken(string $email): string {
        try {
            $token = Str::random(60);

            DB::table($this->table)
                ->updateOrInsert(
                    ['email' => $email],
                    [
                        'token'      => $token,
                        'created_at' => Carbon::now(),
                    ]
                );

            return $token;
        } catch (Exception $e) {
            Log::error('PasswordResetRepository::createToken', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);

            throw new Exception('Could not create reset token.', 500, $e);
        }
    }

    /**
     * Retrieve a password reset record by token.
     *
     * @param string $token
     * @return object|null The DB record (email, token, created_at) or null
     * @throws Exception If any error occurs in the process
     */
    public function getByToken(string $token): ?object {
        try {
            return DB::table($this->table)
                ->where('token', $token)
                ->where('created_at', '>=', Carbon::now()->subMinutes($this->expires))
                ->first();
        } catch (Exception $e) {
            Log::error('PasswordResetRepository::getByToken', [
                'token' => $token,
                'error' => $e->getMessage(),
            ]);

            throw new Exception('Could not retrieve reset token.', 500, $e);
        }
    }

    /**
     * Delete the password reset record for the given email.
     *
     * @param string $email
     * @return void
     * @throws Exception If any error occurs in the process
     */
    public function deleteByEmail(string $email): void {
        try {
            DB::table($this->table)
                ->where('email', $email)
                ->delete();
        } catch (Exception $e) {
            Log::error('PasswordResetRepository::deleteByEmail', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);

            throw new Exception('Could not delete reset token.', 500, $e);
        }
    }
}
