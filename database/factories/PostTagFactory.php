<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\user\tag;
use App\Model\user\post;
use App\Model\user\post_tag;
use Faker\Generator as Faker;

$factory->define(post_tag::class, function (Faker $faker) {
    return [
        'post_id' => function() {
            return post::all()->random();
        },
        'tag_id' => function() {
            return tag::all()->random();
        },
    ];
});
