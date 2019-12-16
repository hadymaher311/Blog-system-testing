<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Model\user\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginTest extends TestCase
{
    /**
     * The login form can be displayed.
     *
     * @return void
     */
    public function test_login_form_displayed()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    /**
     * A valid user can be logged in.
     *
     * @return void
     */
    public function test_login_a_valid_user()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
    
    /**
     * A valid user can be logged in.
     *
     * @return void
     */
    public function test_login_a_valid_user_with_remember_me()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
            'remember' => true
        ]);
        $response->assertCookie('remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
    
    /**
     * An invalid user cannot be logged in.
     *
     * @return void
     */
    public function test_does_not_login_an_invalid_user()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
    /**
     * A logged in user can be logged out.
     *
     * @return void
     */
    public function test_logout_an_authenticated_user()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }
}
