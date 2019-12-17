<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\admin\admin;
use Illuminate\Support\Str;
use App\Model\admin\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_page_response_without_login()
    {
        $response = $this->get('admin/permission');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/permission');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_create_page_response_without_login()
    {
        $response = $this->get('admin/permission/create');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_create_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/permission/create');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_edit_page_response_without_login()
    {
        $permission = factory(Permission::class)->create();
        $response = $this->get('admin/permission/' . $permission->id . '/edit');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_edit_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $permission = factory(Permission::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/permission/' . $permission->id . '/edit');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_store_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $items = ['post', 'user', 'other'];
        $response = $this->post('admin/permission/', [
            'name' => Str::random(12),
            'for' => $items[array_rand($items)]
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_store_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $items = ['post', 'user', 'other'];
        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/permission/', [
                'name' => Str::random(12),
                'for' => $items[array_rand($items)]
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_store_response_with_login_with_invalide_data()
    {
        $admin = factory(admin::class)->create();

        $items = ['post', 'user', 'other'];
        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/permission/', [
                'name' => '',
                'for' => '',
            ]);
        $response->assertSessionHasErrors();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_update_response_without_login()
    {
        $permission = factory(Permission::class)->create();
        $items = ['post', 'user', 'other'];
        $response = $this->put('admin/permission/' . $permission->id, [
            'name' => Str::random(12),
            'for' => $items[array_rand($items)]
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_update_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $permission = factory(Permission::class)->create();
        $items = ['post', 'user', 'other'];

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/permission/' . $permission->id, [
                'name' => Str::random(12),
                'for' => $items[array_rand($items)]
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_update_response_with_login_with_invalide_data()
    {
        $admin = factory(admin::class)->create();
        $permission = factory(Permission::class)->create();
        $items = ['post', 'user', 'other'];

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/permission/' . $permission->id, [
                'name' => '',
                'for' => '',
            ]);
        $response->assertSessionHasErrors();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_delete_response_without_login()
    {
        $permission = factory(Permission::class)->create();
        $response = $this->delete('admin/permission/' . $permission->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permissions_delete_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $permission = factory(Permission::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->delete('admin/permission/' . $permission->id);
        $response->assertStatus(302);
        $this->assertDeleted($permission);
    }
}
