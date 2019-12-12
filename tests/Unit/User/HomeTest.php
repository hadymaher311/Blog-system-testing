<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Model\user\tag;
use App\Model\user\post;
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
        $tag = tag::find(1);
        $response = $this->get('/post/tag/' . $tag->slug);

        $response->assertStatus(200);
    }
    
    public function test_category_page_without_login()
    {
        $category = category::find(1);
        $response = $this->get('/post/category/' . $category->slug);

        $response->assertStatus(200);
    }
}
