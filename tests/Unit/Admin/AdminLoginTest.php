<?php

//namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\user\tag;
use App\Model\user\post;
use App\Model\user\category;
use App\Model\user\User;
use Faker\Generator as Faker;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminTest extends TestCase
{
    use WithoutMiddleware;

    public function testLoginPost(){
        $this->visit('/login')
        ->see('login')
        ->type('nlehner@example.org', 'email')
        ->type('secret', 'password')
        ->check('remember')
        ->press('Login')
        ->seePageIs('/login')
        ->assertRedirect('/home');
    }


    // public function testLoginFalse()
    // {
    //     $credential = [
    //         'email' => 'nlehner@example.org',
    //         'password' => 'secrett'
    //     ];
    //     $this->post('login',$credential)->assertRedirect('/login');
    // }
}
























