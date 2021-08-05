<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_basic_request1()
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
     * Testing resetpassword function
     * @dataProvider resetData
     */
    public function testResetPassword($username, $password, $newPassword, $status, $redirectTo)
    {
        $response = $this->from('forgotPass')
            ->post(
                "update",
                [
                    "username" => $username,
                    "new_password" => $password,
                    "confirm_password" => $newPassword,
                ]);

        $response->assertStatus($status);

        if ($password != $newPassword) {
            $response->assertSessionHasErrors('confirm_password');
        } else if ($username == null) {
            $response->assertSessionHasErrors('username');
        } else {
            $response->assertRedirect($redirectTo);
        }
    }

    /**
     * Data provider for testResetPassword
     */
    public function resetData()
    {
        return ([
            ["504", "012345", "012345", 302, "forgotPass"],     //correct password
            ["", "abcd123", "abcd123", 302, "forgotPass"],      //user id null
            ["501", "852369", "xyz123", 302, "forgotPass"],     //incorrect password

        ]);
    }

    public function testRegister()
    {
        //fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->from('register')
            ->post(
                "register",
                [
                    "first_name" => 'sushma',
                    "last_name" => 'G',
                    "password" => '1234569',
                    "phone_number" => '9632587412',
                    "comm_address" => 'sushma banglore',
                    "gender" => 'female',
                    "city" => 'banglore',
                    "DOB" => '11/05/1999',

                ]);

        $response->assertStatus(302);

        $response->assertRedirect('register');

    }

    /**
     * Testing submitissue function
     * @dataProvider issueData
     */
    public function testCreateIssues($id, $type, $desc)
    {
        $response = $this->from('userdashboard')
            ->call("GET",
                "issue",
                [
                    'emp_id' => $id,
                    'issue_type' => $type,
                    'issue_desc' => $desc,
                ]);

        $response->assertStatus(302);

        if ($id == null) {
            $response->assertSessionHasErrors('emp_id');
        } else if ($type == null) {
            $response->assertSessionHasErrors('issue_type');
        } else if ($desc == null) {
            $response->assertSessionHasErrors('issue_desc');
        } else {
            $response->assertRedirect('userdashboard');
        }
    }

    /**
     * Data provider for testCreateIssues
     */
    public function issueData()
    {
        return ([
            ["504", "login issue", "cannot login MS teams"],
            ["502", "", ""],
            ["501", "windows", "not working"],
        ]);
    }

    /**
     * Testing updateMobile function
     * @dataProvider mobileData
     */
    public function testUpdateMobile($num, $id)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->from('userdashboard')
        ->post(
                "updateMobile",
                [
                    'emp_id' => $id,
                    'phone_number' => $num,
                ]);
        $response->assertStatus(302);
        $response->assertRedirect('userdashboard');

    }

    /**
     * Data provider for testUpdateMobile
     */
    public function mobileData()
    {
        return ([
            ["504", "6382546385"],
        ]);
    }

}
