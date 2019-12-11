<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\user\tag;
use Faker\Generator as Faker;

$factory->define(tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug,
    ];
});
