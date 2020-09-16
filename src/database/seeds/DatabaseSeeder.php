<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @author : Phi .
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 2)->create();
        factory(\App\Models\OauthClient::class, 1)->create();
        factory(\App\Models\OauthPersonalAccessClient::class, 1)->create();
    }
}
