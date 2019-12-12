<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\admin\admin;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(admin::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone' => $faker->phoneNumber,
        'status' => $faker->numberBetween(0, 1),
    ];
});
