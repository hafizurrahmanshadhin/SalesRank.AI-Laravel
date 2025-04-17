<?php

namespace App\Interfaces\Api\V1\Auth;

interface PasswordResetRepositoryInterface {
    /**
     * @param string $email
     * @return string The newly created token
     */
    public function createToken(string $email): string;

    /**
     * @param string $token
     * @return object|null The DB record (email, token, created_at) or null
     */
    public function getByToken(string $token): ?object;

    /**
     * @param string $email
     * @return void
     */
    public function deleteByEmail(string $email): void;
}
