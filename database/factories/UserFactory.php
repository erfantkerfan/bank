<?php

use Faker\Generator as Faker;
use use Illuminate\Support\Str;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'username' => $faker->unique()->userName,
        'f_name' => $faker->unique()->name,
        'l_name' => $faker->unique()->name,
        'acc_id' => $faker->randomDigitNotNull.$faker->randomDigitNotNull.$faker->randomDigitNotNull,
        'phone_number' => $faker->randomDigitNotNull.$faker->randomDigitNotNull.$faker->randomDigitNotNull.$faker->randomDigitNotNull.
            $faker->randomDigitNotNull.$faker->randomDigitNotNull.$faker->randomDigitNotNull.$faker->randomDigitNotNull.
            $faker->randomDigitNotNull.$faker->randomDigitNotNull.$faker->randomDigitNotNull,
        'is_admin' => '0',
        'is_super_admin' => '0',
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10),
        'relation' => Str::random(10),
        'note' => Str::random(10),
    ];
});
