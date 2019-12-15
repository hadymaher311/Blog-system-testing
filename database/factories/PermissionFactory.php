<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model\admin\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'for' => $faker->randomElement(['post', 'user', 'other']),
    ];
});
