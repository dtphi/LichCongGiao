<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OauthClient;
use Faker\Generator as Faker;

$factory->define(OauthClient::class, function (Faker $faker) {
    return [
        'name'                   => '121round',
        'secret'                 => 'xKbXIcHyic8BfcR0MYblC6Vyp9N6zRgH7XTqtInO',
        'redirect'               => 'http://localhost',
        'personal_access_client' => 1,
        'password_client'        => 0,
        'revoked'                => 0,
        'created_at'             => now(),
        'updated_at'             => now()
    ];
});
