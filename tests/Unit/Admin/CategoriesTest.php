<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\admin\role;
use App\Model\admin\admin;
use Illuminate\Support\Str;
use App\Model\user\category;
use App\Model\admin\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_page_response_without_login()
    {
        $response = $this->get('admin/category');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/category');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_create_page_response_without_login()
    {
        $response = $this->get('admin/category/create');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_create_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/category/create');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_edit_page_response_without_login()
    {
        $category = factory(category::class)->create();
        $response = $this->get('admin/category/' . $category->id . '/edit');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_edit_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $category = factory(category::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/category/' . $category->id . '/edit');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_show_page_response_without_login()
    {
        $category = factory(category::class)->create();
        $response = $this->get('admin/category/' . $category->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_show_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $category = factory(category::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/category/' . $category->id);
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_store_response_without_login()
    {
        $response = $this->post('admin/category/', [
            'name' => Str::random(12),
            'slug' => Str::random(12),
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_store_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/category/', [
                'name' => Str::random(12),
                'slug' => Str::random(12),
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_store_response_with_login_with_invalide_data()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/category/', [
                'name' => '',
                'slug' => '',
            ]);
        $response->assertSessionHasErrors();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_update_response_without_login()
    {
        $category = factory(category::class)->create();
        $response = $this->put('admin/category/' . $category->id, [
            'name' => Str::random(12),
            'slug' => Str::random(12),
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_update_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $category = factory(category::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/category/' . $category->id, [
                'name' => Str::random(12),
                'slug' => Str::random(12),
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_update_response_with_login_with_invalide_data()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $category = factory(category::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/category/' . $category->id, [
                'name' => '',
                'slug' => '',
            ]);
        $response->assertSessionHasErrors();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_delete_response_without_login()
    {
        $category = factory(category::class)->create();
        $response = $this->delete('admin/category/' . $category->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_delete_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(12);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $category = factory(category::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->delete('admin/category/' . $category->id);
        $response->assertStatus(302);
        $this->assertDeleted($category);
    }
}
