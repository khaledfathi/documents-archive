<?php

namespace App\Providers;

use App\Repository\Contracts\Document\ElectricityRepositoryContract;
use App\Repository\Contracts\Document\GasRepositoryContract;
use App\Repository\Contracts\Document\WaterRepositoryContract;
use App\Repository\Contracts\Log\UserLogRepositoryContract;
use App\Repository\Contracts\User\UserRepositoryContract;
use App\Repository\Document\ElectriciryRepository;
use App\Repository\Document\GasRepository;
use App\Repository\Document\WaterRepository;
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
        $this->app->bind(ElectricityRepositoryContract::class , ElectriciryRepository::Class); 
        $this->app->bind(WaterRepositoryContract::class , WaterRepository::class); 
        $this->app->bind(GasRepositoryContract::class , GasRepository::class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
