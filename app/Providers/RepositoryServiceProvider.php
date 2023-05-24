<?php

namespace App\Providers;

use App\Repository\Contracts\UserRepositoryContracts;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Handle database as a Repositories 
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services. 
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContracts::class , UserRepository::Class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
