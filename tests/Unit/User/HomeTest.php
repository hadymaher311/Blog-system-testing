<?php

namespace Tests\Unit\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_home_page_responce_without_login()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function test_post_page_without_login()
    {
        $response = $this->get('/post/1');
    
        $response->assertStatus(200);
    }
}
