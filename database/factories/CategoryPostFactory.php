<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\user\post;
use App\Model\user\category;
use Faker\Generator as Faker;
use App\Model\user\category_post;

$factory->define(category_post::class, function (Faker $faker) {
    return [
        'category_id' => function() {
            return category::all()->random();
        },
        'post_id' => function() {
            return post::all()->random();
        },
    ];
});
