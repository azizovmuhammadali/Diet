<?php

namespace App\Providers;

use App\Interfaces\Reposities\ProductReposityInterface;
use App\Interfaces\Reposities\UserReposityInterface;
use App\Interfaces\Services\ProductServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Reposities\ProductReposity;
use App\Reposities\UserReposity;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ConnectorProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserReposityInterface::class,UserReposity::class);
        $this->app->bind(UserServiceInterface::class,UserService::class);
        $this->app->bind(ProductReposityInterface::class,ProductReposity::class);
        $this->app->bind(ProductServiceInterface::class,ProductService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
