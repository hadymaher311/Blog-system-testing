<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\admin\admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * The login form can be displayed.
     *
     * @return void
     */
    public function test_login_form_displayed()
    {
        $response = $this->get('/admin-login');
        $response->assertStatus(200);
    }
    /**
     * A valid admin can be logged in.
     *
     * @return void
     */
    public function test_login_a_valid_admin()
    {
        $admin = factory(admin::class)->create();
        $response = $this->post('/admin-login', [
            'email' => $admin->email,
            'password' => 'secret'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($admin, 'admin');
    }
    
    /**
     * An invalid admin cannot be logged in.
     *
     * @return void
     */
    public function test_does_not_login_an_invalid_admin()
    {
        $admin = factory(admin::class)->create();
        $response = $this->post('/admin-login', [
            'email' => $admin->email,
            'password' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest('admin');
    }
}
