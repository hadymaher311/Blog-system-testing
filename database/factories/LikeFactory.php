<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\user\like;
use App\Model\user\post;
use App\Model\user\User;
use Faker\Generator as Faker;

$factory->define(like::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::all()->random();
        },
        'post_id' => function() {
            return post::all()->random();
        },
    ];
});
