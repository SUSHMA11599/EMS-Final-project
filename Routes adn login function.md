Route::view('login','login');
Route::post('users',[LoginController::class,'validateCredentials']);
Route::get('user/{id}',[NormaluserController::class,'showUser']);
Route::get('admin/{id}',[EmployeeListController::class, 'show']);
Route::view('pass','resetPassword');
Route::post('reset',[ResetPasswordController::class,'resetpassword']);


/**
 * login credentil function
 */

public function validateCredentials(Request $req)
    {
        $validate = new Validate();
        $validate->validateUsername($req->Username);
        if ($validate->validateUsername($req->Username)) {
            $id = 0;
            $user = ucfirst($req->Username);
            $name = '';
            for ($num = 0; $num < strlen($user); $num++) {
                if ($user[$num] >= '0' && $user[$num] <= '9') {
                    $id = $id * 10 + ($user[$num]-'0');
                } else {
                    $name = $name . $user[$num];
                }
            }
            $user = employees::find($id);
            try {

                if ($user->first_name == $name && $req->Password == $user->password) {

                    if (ucfirst($user->user_type) == 'Normal User') {
                        return redirect("user/$user->id");
                    } else if (ucfirst($user->user_type) == 'Manager') {
                        return redirect("mng1/$user->id");
                    } else if (ucfirst($user->user_type) == 'Admin') {
                        return redirect("admin/$user->id");
                    }

                } else {
                    return back()->with('message', "Please enter valid Credentials");
                }} catch (Exception $e) {
                return back()->with('message', "Records Not found,Chek your Usename");
            }

        } else {
            return back()->with('message', "Please enter valid Credentials");
        }
    }


      /**
     * A basic test example.
     *
     * @return void
     */
   /* public function test_a_basic_request4()
    {
        $response = $this->get('/signin');

        //$response->assertGet('login');
        $response->assertStatus(200);
    }*/

    /* public function testNormalUser()
    {
    $response = $this->post(uri:'/signin', data:[
    "username" => 501,
    "password" => "98765",
    ]
    );
    $this->assertAuthenticated();
    $response->assertRedirect(uri:'/userdashboard');
    }*/

    /*public function testLoginTrue()
    {
    $credential = [
    "username" => 501,
    "password" => "98765",
    ];
    $this->post('/signin', $credential)->assertRedirect('/userdashboard');
    }*/

    /*public function testLoginFalse()
    {
    $credential = [
    "username" => 501,
    "password" => "987657",
    ];
    $this->post('/signin', $credential)->assertRedirect('/signin');
    }*/

    /*public function testLoginFalse1()
    {
    $credential = [
    "username" => 501,
    "password" => "98765",
    ];

    $response = $this->post('signin', $credential);

    $response->assertStatus(405);

    //$response->assertSessionHasErrors();
    }*/

    /* public function test_user_cannot_view_a_login_form_when_authenticated()
    {
    $user = factory(User::class)->make();

    $response = $this->actingAs($user)->get('/');

    $response->assertRedirect('/home');
    }*/

    /** @test */
    /*public function login_displays_validation_errors()
    {
    $response = $this->post('/signin', []);

    $credential = [
    "username" => 501,

    ];

    $response = $this->post('signin', $credential);

    $response->assertStatus(405);
    $response->assertSessionHasErrors('password');
    }*/
