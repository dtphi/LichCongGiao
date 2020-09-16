<?php

namespace App\Providers;

use App\ThdModelServices\ThdContracts\ThdAdmin\LcgAdminUserContract;
use App\ThdModelServices\ThdServices\ThdAdmin\LcgAdminUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LcgAdminUserContract::class,LcgAdminUserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
