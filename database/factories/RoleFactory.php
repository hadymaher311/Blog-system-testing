<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\admin\role;
use Faker\Generator as Faker;

$factory->define(role::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
