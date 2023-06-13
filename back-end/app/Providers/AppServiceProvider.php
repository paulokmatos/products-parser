<?php

namespace App\Providers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductEloquentORM;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductEloquentORM::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
