<?php

namespace Tests\Unit;

use Tests\TestCase;

class routestest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_routes()
    {
        $homeresponse = $this->get('/');
        $signin = $this->get('/signin');
        $register = $this->get('/register');
        $forgotpass = $this->get('/forgotPass');
        $issue = $this->get('issue');

        $homeresponse->assertStatus(200);
        $signin->assertStatus(200);
        $register->assertStatus(200);
        $forgotpass->assertStatus(200);
    }

    public function test_welcome_view()
    {
        $view = $this->view('welcome');

        $view->assertSee('Welcome to Employee Management System');

    }

    public function test_updateMobile()
    {
        $response = $this->call('POST', 'updateMobile', array(
            '_token' => csrf_token(),
        ));
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @dataProvider loginData
     */
    public function testLogin($userid, $password, $expected){

        $response = $this->call('GET', 'http://127.0.0.1:8000/login', [
            "username"=>$userid,
            "password"=>$password
        ]);
        // fwrite(STDOUT, $response->getContent() );
        $response->assertSee($expected);
    }

    public function loginData(){
        return [
            [505,"12345","Welcome"],
            [503,"Shan123","Welcome"],
        ];
    }

    
    /**
     * Testing Reset Password Route
     */
    public function test_a_basic_request1()
    {
        $response = $this->get('/forgotPass');

        $response->assertViewIs('forgotPassword');

        $response->assertStatus(200);
    }

}
