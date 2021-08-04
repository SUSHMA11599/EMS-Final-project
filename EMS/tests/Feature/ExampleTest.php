<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

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

        $response->assertStatus(200);
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
        $response->assertStatus(200);
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

    public function testNormalUser()
    {
        $response = $this->post(uri:'/signin', data:[
            "username" => 501,
            "password" => "98765",
        ]
        );
        $this->assertAuthenticated();
        $response->assertRedirect(uri:'/userdashboard');
    }

    public function testLoginTrue()
    {
        $credential = [
            "username" => 501,
            "password" => "98765",
        ];
        $this->post('/signin', $credential)->assertRedirect('/userdashboard');
    }

    public function testLoginFalse()
    {
        $credential = [
            "username" => 501,
            "password" => "987657",
        ];
        $this->post('/signin', $credential)->assertRedirect('/signin');
    }

    public function testLoginFalse1()
    {
        $credential = [
            "username" => 501,
            "password" => "98765",
        ];

        $response = $this->post('signin', $credential);

        $response->assertStatus(405);

        //$response->assertSessionHasErrors();
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/');

        $response->assertRedirect('/home');
    }

    /** @test */
    public function login_displays_validation_errors()
    {
        $response = $this->post('/signin', []);

        $credential = [
            "username" => 501,
            
        ];

        $response = $this->post('signin', $credential);

        $response->assertStatus(405);
        $response->assertSessionHasErrors('password');
    }

}
