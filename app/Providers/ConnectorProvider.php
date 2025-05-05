<?php

namespace App\Providers;

use App\Interfaces\Reposities\LanguageReposityInterface;
use App\Interfaces\Reposities\OrderReposityInterface;
use App\Interfaces\Reposities\ProductReposityInterface;
use App\Interfaces\Reposities\TranslationReposityInterface;
use App\Interfaces\Reposities\UserReposityInterface;
use App\Interfaces\Services\LanguageServiceInterface;
use App\Interfaces\Services\OrderServiceInterface;
use App\Interfaces\Services\ProductServiceInterface;
use App\Interfaces\Services\TranslationServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Reposities\LanguageReposity;
use App\Reposities\OrderReposity;
use App\Reposities\ProductReposity;
use App\Reposities\TranslationReposity;
use App\Reposities\UserReposity;
use App\Services\LanguageService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\TranslationService;
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
        $this->app->bind(OrderReposityInterface::class,OrderReposity::class);
        $this->app->bind(OrderServiceInterface::class,OrderService::class);
        $this->app->bind(LanguageReposityInterface::class,LanguageReposity::class);
        $this->app->bind(LanguageServiceInterface::class,LanguageService::class);
        $this->app->bind(TranslationReposityInterface::class,TranslationReposity::class);
        $this->app->bind(TranslationServiceInterface::class,TranslationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
