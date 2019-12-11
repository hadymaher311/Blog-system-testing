<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\admin\role;
use App\Model\admin\admin;
use Faker\Generator as Faker;
use App\Model\admin\admin_role;

$factory->define(admin_role::class, function (Faker $faker) {
    return [
        'admin_id' => function() {
            return admin::all()->random();
        },
        'role_id' => function() {
            return role::all()->random();
        },
    ];
});
