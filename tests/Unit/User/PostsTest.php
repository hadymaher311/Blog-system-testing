<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Model\user\post;
use App\Model\user\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_posts_without_login()
    {
        $response = $this->post('/getPosts');
        $response->assertStatus(200);
    }

    public function test_get_all_posts_with_login()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])->post('/getPosts');
        $response->assertStatus(200);
    }

    public function test_save_post_like_without_login()
    {
        $post = factory(post::class)->create();
        $response = $this->post('/saveLike', [
            'id' => $post->id,
        ]);
        $response->assertStatus(200);
    }

    public function test_save_post_like_with_login()
    {
        $user = factory(User::class)->create();
        $post = factory(post::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])->post('/saveLike', [
                'id' => $post->id,
            ]);
        $response->assertStatus(200);
    }
    
    public function test_get_post_without_login()
    {
        $post = factory(post::class)->create();
        $response = $this->get($post->slug);
        $response->assertStatus(200);
    }

    public function test_get_post_with_login()
    {
        $user = factory(User::class)->create();
        $post = factory(post::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])->get($post->slug);
        $response->assertStatus(200);
    }
}
