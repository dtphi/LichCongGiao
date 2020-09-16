<?php

namespace App\Providers;

use App\Models\Information;
use App\Observers\InformationObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use URL;

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
        $this->app->bind(
            'App\Commons\ServiceContract',
            'App\Commons\Service'
        );
        $this->app->bind(
            'App\Services\Contracts\UserContract',
            'App\Services\UserService'
        );
        $this->app->bind(
            'App\Services\Contracts\ExamContract',
            'App\Services\ExamService'
        );
        $this->app->bind(
            'App\Services\Contracts\CredoContract',
            'App\Services\CredoService'
        );
        $this->app->bind(
            'App\Services\Contracts\BaseContract',
            'App\Services\BaseService'
        );
        $this->app->bind(
            'App\Services\Contracts\InformationContract',
            'App\Services\InformationService'
        );
    }

    /**
     * @author : Phi .
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $scheme = config('app.force_https');
        if (is_null($scheme) || $scheme) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

        Paginator::defaultView('layouts.partials.pagination');
        Paginator::defaultSimpleView('layouts.partials.pagination');

        /**
         * Extending Blade .
         * call inside blade : @currency_money($param);
         */
        Blade::directive('currency_money', function ($amount) {
            return "<?php echo number_format($amount, 0); ?>";
        });
        Blade::directive('display_phone', function ($amount) {
            return "<?php echo substr($amount, 0, 2).'-'.substr($amount, 2, 4).'-'.substr($amount,6); ?>";
        });

        Information::observe(InformationObserver::class);
    }
}
