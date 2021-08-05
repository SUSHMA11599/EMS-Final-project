<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * set Previous url
     */
    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);
        return $this;
    }

    /**
     * Login Test
     * @dataProvider loginData
     */

    public function testLogin($username, $password, $status, $redirectTo)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . " $username" . " $password\n");
        $response = $this->from('login')
            ->post(
                '/users', [
                    "Username" => $username,
                    "Password" => $password,
                ]);
        $response->assertStatus($status);
        $response->assertRedirect($redirectTo);
    }

    /**
     * Data provider for testLogin function
     */

    public function loginData()
    {
        return ([
            ["vijay121", "abcd123", 302, "admin/121"], // admin
            ["Prakash115", "abcd123", 302, "user/115"], // Normal user
            ["kavya127", "abcd", 302, "login"], //wrong password
            ["abcd123", "1234", 302, "login"], // invalid credenial
        ]);
    }

    /**
     * Testing Login Route
     */

    public function testRouteLogin()
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->get("login");
        $response->assertStatus(200);
    }

    /**
     * Testing Reset Password Route
     */

    public function testResetPasswordRoute()
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->get("pass");
        $response->assertStatus(200);
    }

    /**
     * Testing resetpassword function
     * @dataProvider resetData
     */

    public function testResetPassword($username, $password, $newPassword, $status, $redirectTo)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->from('pass')
            ->post(
                "reset",
                [
                    "username" => $username,
                    "password" => $password,
                    "newpassword" => $newPassword,
                ]);

        $response->assertStatus($status);
        $response->assertRedirect($redirectTo);
    }

    /**
     * Data provider for testResetPassword
     */

    public function resetData()
    {
        return ([
            ["Shikar119", "abcd123", "abcd123", 302, "login"],
            ["Shikar119", "abcd123", "xyz123", 302, "pass"],
        ]);
    }

}
