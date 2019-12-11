<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\admin\role;
use Faker\Generator as Faker;
use App\Model\admin\Permission;
use App\Model\admin\permission_role;

$factory->define(permission_role::class, function (Faker $faker) {
    return [
        'permission_id' => function() {
            return Permission::all()->random();
        },
        'role_id' => function() {
            return role::all()->random();
        },
    ];
});
