<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * @author : Phi .
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        if (function_exists('get_personal_access_client_id')) {
            Passport::personalAccessClientId(get_personal_access_client_id());
        }

        Passport::tokensExpireIn(Carbon::now()->addSecond(60));
        Passport::refreshTokensExpireIn(Carbon::now()->addDay(30));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addHour(3));

        Passport::tokensCan([
		    '121round' => 'admin'
		]);
    }
}
