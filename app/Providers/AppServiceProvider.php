<?php

namespace App\Providers;

use App\Interfaces\Api\V1\Auth\UserRepositoryInterface;
use App\Repositories\Api\V1\Auth\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        // auth
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        //
    }
}
