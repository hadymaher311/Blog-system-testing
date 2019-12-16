<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\user\post;
use App\Model\user\User;
use App\Model\admin\admin;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_page_response_without_login()
    {
        $response = $this->get('admin/user');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/user');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_create_page_response_without_login()
    {
        $response = $this->get('admin/user/create');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_create_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/user/create');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_edit_page_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $response = $this->get('admin/user/' . $admin->id . '/edit');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_edit_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $admin2 = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/user/' . $admin2->id . '/edit');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_show_page_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $response = $this->get('admin/user/' . $admin->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_show_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $admin2 = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/user/' . $admin2->id);
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_store_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $response = $this->post('admin/user/', [
            'name' => Str::random(12),
            'email' => Str::random(12) . '@gmail.com',
            'phone' => rand(10000000000, 999999999999),
            'password' => 'secret',
            'status' => true,
            'role' => []
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_store_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/user/', [
                'name' => Str::random(12),
                'email' => Str::random(12) . '@gmail.com',
                'phone' => rand(10000000000, 999999999999),
                'password' => 'secret',
                'status' => true,
                'role' => []
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_update_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $admin2 = factory(admin::class)->create();
        $response = $this->put('admin/user/' . $admin2->id, [
            'name' => Str::random(12),
            'email' => Str::random(12) . '@gmail.com',
            'phone' => rand(10000000000, 999999999999),
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_update_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $admin2 = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/user/' . $admin2->id, [
                'name' => Str::random(12),
                'email' => Str::random(12) . '@gmail.com',
                'phone' => rand(10000000000, 999999999999),
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_delete_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $admin2 = factory(admin::class)->create();
        $response = $this->delete('admin/user/' . $admin2->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admins_delete_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $admin2 = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->delete('admin/user/' . $admin2->id);
        $response->assertStatus(302);
    }
}
