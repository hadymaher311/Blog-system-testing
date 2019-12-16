<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\user\tag;
use App\Model\admin\role;
use App\Model\admin\admin;
use Illuminate\Support\Str;
use App\Model\admin\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_page_response_without_login()
    {
        $response = $this->get('admin/tag');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(11);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/tag');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_create_page_response_without_login()
    {
        $response = $this->get('admin/tag/create');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_create_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(11);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/tag/create');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_edit_page_response_without_login()
    {
        $tag = factory(tag::class)->create();
        $response = $this->get('admin/tag/' . $tag->id . '/edit');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_edit_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $tag = factory(tag::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(11);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/tag/' . $tag->id . '/edit');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_show_page_response_without_login()
    {
        $tag = factory(tag::class)->create();
        $response = $this->get('admin/tag/' . $tag->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_show_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $tag = factory(tag::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(11);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/tag/' . $tag->id);
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_store_response_without_login()
    {
        $response = $this->post('admin/tag/', [
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
    public function test_tags_store_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(11);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/tag/', [
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
    public function test_tags_update_response_without_login()
    {
        $tag = factory(tag::class)->create();
        $response = $this->put('admin/tag/' . $tag->id, [
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
    public function test_tags_update_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(11);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $tag = factory(tag::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/tag/' . $tag->id, [
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
    public function test_tags_delete_response_without_login()
    {
        $tag = factory(tag::class)->create();
        $response = $this->delete('admin/tag/' . $tag->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tags_delete_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(11);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $tag = factory(tag::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->delete('admin/tag/' . $tag->id);
        $response->assertStatus(302);
    }
}
