<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Model\user\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetsPasswordTest extends TestCase
{
    /**
     * Displays the reset password request form.
     *
     * @return void
     */
    public function test_displays_password_reset_request_form()
    {
        $response = $this->get('password/reset');
        $response->assertStatus(200);
    }
    /**
     * Sends the password reset email when the user exists.
     *
     * @return void
     */
    public function test_sends_password_reset_email()
    {
        $user = factory(User::class)->create();
        $this->expectsNotification($user, ResetPassword::class);
        $response = $this->post('password/email', ['email' => $user->email]);
        $response->assertStatus(302);
    }
    /**
     * Does not send a password reset email when the user does not exist.
     *
     * @return void
     */
    public function test_does_not_send_password_reset_email()
    {
        $this->doesntExpectJobs(ResetPassword::class);
        $this->post('password/email', ['email' => 'invalid@email.com']);
    }
    /**
     * Displays the form to reset a password.
     *
     * @return void
     */
    public function test_displays_password_reset_form()
    {
        $response = $this->get('/password/reset/token');
        $response->assertStatus(200);
    }
    /**
     * Allows a user to reset their password.
     *
     * @return void
     */
    public function test_changes_a_users_password()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);
        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
