<?php

namespace App\Interfaces\Api\V1\Auth;

use App\Models\User;

interface UserRepositoryInterface {
    /**
     * Creates a new user with the provided credentials.
     * @param array $credentials
     * @param int $role
     * @return void
     */
    public function createUser(array $credentials, int $role): User;

    /**
     * Attempts to retrieve a user by their login credentials.
     *
     * @param array $credentials The user's login credentials (email and password).
     *
     * @return User|null The user object if found, null otherwise.
     */
    public function login(array $credentials): User | null;

    /**
     * Find a user by their email address.
     *
     * @param  string     $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
