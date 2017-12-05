<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    $now = \Carbon\Carbon::now()->toDateTimeString();

    return [
        'username'       => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'name'           => $faker->name,
        'introduction'   => $faker->sentence(),
        'avatar'         => '',
        'source'         => \App\Models\User::SOURCE_WEB,
        'is_delete'      => 0,
        'created_at'     => $now,
        'updated_at'     => $now,
    ];
});
