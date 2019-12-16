<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\admin\role;
use App\Model\admin\admin;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_page_response_without_login()
    {
        $response = $this->get('admin/role');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/role');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_create_page_response_without_login()
    {
        $response = $this->get('admin/role/create');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_create_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/role/create');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_edit_page_response_without_login()
    {
        $role = factory(role::class)->create();
        $response = $this->get('admin/role/' . $role->id . '/edit');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_edit_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/role/' . $role->id . '/edit');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_show_page_response_without_login()
    {
        $role = factory(role::class)->create();
        $response = $this->get('admin/role/' . $role->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_show_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/role/' . $role->id);
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_store_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $response = $this->post('admin/role/', [
            'name' => Str::random(12),
            'permissions' => []
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_store_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/role/', [
                'name' => Str::random(12),
                'permissions' => []
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_update_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $response = $this->put('admin/role/' . $role->id, [
            'name' => Str::random(12),
            'permissions' => []
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_update_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/role/' . $role->id, [
                'name' => Str::random(12),
                'permissions' => []
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_delete_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $response = $this->delete('admin/role/' . $role->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_roles_delete_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->delete('admin/role/' . $role->id);
        $response->assertStatus(302);
    }
}
