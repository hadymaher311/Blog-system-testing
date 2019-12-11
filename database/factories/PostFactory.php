<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\user\post;
use App\Model\admin\admin;
use Faker\Generator as Faker;

$factory->define(post::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'subtitle' => $faker->word,
        'slug' => $faker->slug,
        'body' => $faker->text,
        'status' => $faker->numberBetween(0, 1),
        'posted_by' => function() {
            return admin::all()->random();
        },
        'image' => $faker->image,
        'like' => $faker->randomNumber,
        'dislike' => $faker->randomNumber,
    ];
});
