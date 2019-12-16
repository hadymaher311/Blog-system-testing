<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\admin\admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admin_home_page_response_without_login()
    {
        $response = $this->get('admin/home');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admin_home_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/home');
        $response->assertOk();
    }
}
