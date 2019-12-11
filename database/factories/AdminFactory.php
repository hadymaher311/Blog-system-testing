<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\admin\admin;
use Faker\Generator as Faker;

$factory->define(admin::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone' => $faker->phone,
        'status' => $faker->numberBetween(0, 1),
        'remember_token' => str_random(10),
    ];
});
