<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Model\user\post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $post = factory(post::class)->make();
        $response = $this->get('/post/' . $post->id);

        $response->assertStatus(200);
    }
}
