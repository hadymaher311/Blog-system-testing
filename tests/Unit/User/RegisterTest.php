<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Model\user\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * The registration form can be displayed.
     *
     * @return void
     */
    public function test_register_form_displayed()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
    /**
     * A valid user can be registered.
     *
     * @return void
     */
    public function test_registers_a_valid_user()
    {
        $user = factory(User::class)->make();
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticated();
    }
    /**
     * An invalid user is not registered.
     *
     * @return void
     */
    public function test_does_not_register_an_invalid_user()
    {
        $user = factory(User::class)->make();
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
