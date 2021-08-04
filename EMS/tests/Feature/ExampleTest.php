<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Http\Controllers\validate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Models\User;

class ExampleTest extends TestCase
{

     /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/signin');
        $response->assertViewIs('login');

        //$response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_basic_request1()
    {
        $response = $this->get('/forgotPass');

        
        $response->assertViewIs('forgotPassword');

        //$response->assertStatus(200);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_basic_request()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_basic_request2()
    {
        $response = $this->get('/');

        $response->assertViewIs('welcome');
       // $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_basic_request4()
    {
        $response = $this->get('/signin');

        //$response->assertGet('login');
        $response->assertStatus(200);
    }

    /*public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/');

        //$response->assertRedirect('/home');
    }*/

}
