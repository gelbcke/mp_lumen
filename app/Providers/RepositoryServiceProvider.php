<?php

namespace App\Providers;

use App\Interfaces\VehicleRepositoryInterface;
use App\Repositories\VehicleRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(VehicleRepositoryInterface::class, VehicleRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
