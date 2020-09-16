<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OauthPersonalAccessClient;
use Faker\Generator as Faker;

$factory->define(OauthPersonalAccessClient::class, function (Faker $faker) {
    return [
        'client_id'  => '1',
        'created_at' => now(),
        'updated_at' => now()
    ];
});
