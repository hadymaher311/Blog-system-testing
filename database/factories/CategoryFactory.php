<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\user\category;
use Faker\Generator as Faker;

$factory->define(category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug,
    ];
});
