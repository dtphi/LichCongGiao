<?php

namespace App\Providers;

use App\Http\LcgServices\LcgContracts\LcgUserContract;
use App\Http\LcgServices\LcgUserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @author : Phi .
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LcgUserContract::class,LcgUserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
