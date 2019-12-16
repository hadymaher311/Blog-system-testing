<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\user\post;
use App\Model\admin\role;
use App\Model\admin\admin;
use Illuminate\Support\Str;
use App\Model\admin\Permission;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_page_response_without_login()
    {
        $response = $this->get('admin/post');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_page_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/post');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_create_page_response_without_login()
    {
        $response = $this->get('admin/post/create');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_create_page_response_with_login_without_permission()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/post/create');
        $response->assertStatus(302);
    }
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_create_page_response_with_login_with_permission()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(4);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/post/create');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_edit_page_response_without_login()
    {
        $post = factory(post::class)->create();
        $response = $this->get('admin/post/' . $post->id . '/edit');
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_edit_page_response_with_login_without_permission()
    {
        $admin = factory(admin::class)->create();
        $post = factory(post::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/post/' . $post->id . '/edit');
        $response->assertStatus(302);
    }
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_edit_page_response_with_login_with_permission()
    {
        $admin = factory(admin::class)->create();
        $role = factory(role::class)->create();
        $permission = Permission::find(5);
        $admin->roles()->attach($role);
        $role->permissions()->attach($permission);
        $post = factory(post::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/post/' . $post->id . '/edit');
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_show_page_response_without_login()
    {
        $post = factory(post::class)->create();
        $response = $this->get('admin/post/' . $post->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_show_page_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $post = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->get('admin/post/' . $post->id);
        $response->assertOk();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_store_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $response = $this->post('admin/post/', [
            'title' => Str::random(12),
            'subtitle' => Str::random(8),
            'slug' => Str::random(8),
            'body' => Str::random(100),
            'image' => './home-bg.jpg'
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_store_response_with_login()
    {
        $admin = factory(admin::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->post('admin/post/', [
                'title' => Str::random(12),
                'subtitle' => Str::random(8),
                'slug' => Str::random(8),
                'body' => Str::random(100),
                'image' => UploadedFile::fake()->image('avatar.jpg')
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_update_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $post = factory(post::class)->create();
        $response = $this->put('admin/post/' . $post->id, [
            'title' => Str::random(12),
            'subtitle' => Str::random(8),
            'slug' => Str::random(8),
            'body' => Str::random(100),
            'image' => './home-bg.jpg'
        ]);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_update_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $post = factory(post::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->put('admin/post/' . $post->id, [
                'title' => Str::random(12),
                'subtitle' => Str::random(8),
                'slug' => Str::random(8),
                'body' => Str::random(100),
                'image' => './home-bg.jpg'
            ]);
        $response->assertStatus(302);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_delete_response_without_login()
    {
        $admin = factory(admin::class)->create();
        $post = factory(post::class)->create();
        $response = $this->delete('admin/post/' . $post->id);
        $response->assertRedirect('/admin-login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_delete_response_with_login()
    {
        $admin = factory(admin::class)->create();
        $post = factory(post::class)->create();

        $response = $this->actingAs($admin, 'admin')
            ->withSession(['foo' => 'bar'])->delete('admin/post/' . $post->id);
        $response->assertStatus(302);
    }
}
