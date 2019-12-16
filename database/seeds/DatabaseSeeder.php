<?php

use App\Model\user\tag;
use App\Model\user\like;
use App\Model\user\post;
use App\Model\user\User;
use App\Model\admin\role;
use App\Model\admin\admin;
use App\Model\user\category;
use App\Model\user\post_tag;
use App\Model\admin\admin_role;
use App\Model\admin\Permission;
use Illuminate\Database\Seeder;
use App\Model\user\category_post;
use App\Model\admin\permission_role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();
        factory(admin::class, 5)->create();
        factory(role::class, 5)->create();
        factory(Permission::class, 30)->create();
        factory(admin_role::class, 10)->create();
        factory(permission_role::class, 10)->create();
        factory(category::class, 5)->create();
        factory(post::class, 15)->create();
        factory(category_post::class, 10)->create();
        factory(like::class, 20)->create();
        factory(tag::class, 10)->create();
        factory(post_tag::class, 50)->create();
    }
}
