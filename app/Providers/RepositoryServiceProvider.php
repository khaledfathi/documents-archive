<?php

namespace App\Providers;

use App\Repository\Contracts\Log\UserLogRepositoryContract;
use App\Repository\Contracts\User\UserRepositoryContract;
use App\Repository\Log\UserLogRepository;
use App\Repository\User\UserRepository;
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
        $this->app->bind(UserRepositoryContract::class , UserRepository::Class); 
        $this->app->bind(UserLogRepositoryContract::class , UserLogRepository::Class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
