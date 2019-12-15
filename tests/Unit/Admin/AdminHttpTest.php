<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Model\user\tag;
use App\Model\user\post;
use App\Model\user\category;
use App\Model\admin\admin;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminHttpTest extends TestCase
{
     /**
     * A basic unit test example.
     *
     * @return void
     */
   
   public function test_responce_to_login()
   {
       $response = $this->get('/admin-login');

       $response->assertStatus(200);

   }
   
   
   public function test_respose_without_register_to_home()
   {
       $response = $this->get('/admin/home');

       $response->assertStatus(500); 

   }
   
   public function test_respose_without_register_to_user()
   {
       $response = $this->get('/admin/user');

       $response->assertStatus(500); 

   }

   public function test_respose_without_register_to_role()
   {
       $response = $this->get('/admin/role');

       $response->assertStatus(500); 

   }

   public function test_respose_without_register_to_permission()
   {
       $response = $this->get('/admin/permission');

       $response->assertStatus(500); 

   }
   
   public function test_respose_without_register_to_post()
   {
       $response = $this->get('/admin/post');

       $response->assertStatus(500); 

   }

   public function test_respose_without_register_to_tag()
   {
       $response = $this->get('/admin/tag');

       $response->assertStatus(500); 
   }

   public function test_respose_without_register_to_category()
   {
       $response = $this->get('/admin/category');

       $response->assertStatus(500); 

   }

   

}