<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Model\user\tag;
use App\Model\user\post;
use App\Model\user\User;
use App\Model\user\category;
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

    public function test_tag_page_without_login()
    {
        $tag = tag::first();
        $response = $this->get('/post/tag/' . $tag->slug);

        $response->assertStatus(200);
    }

    public function test_category_page_without_login()
    {
        $category = category::first();
        $response = $this->get('/post/category/' . $category->slug);

        $response->assertStatus(200);
    }

    public function test_home_page_responce_with_login()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/');

        $response->assertStatus(200);
    }

    public function test_tag_page_with_login()
    {
        $tag = tag::first();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/post/tag/' . $tag->slug);

        $response->assertStatus(200);
    }

    public function test_category_page_with_login()
    {
        $category = category::first();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/post/category/' . $category->slug);

        $response->assertStatus(200);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_home_page_responce_without_login()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_home_page_responce_with_login()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])->get('/home');
        $response->assertOk();
    }
}
