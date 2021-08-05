<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegController extends Controller
{

    //registering an employee from register form
    public function getFormData(Request $req)
    {
        $req->validate([
            'mobile' => 'required|regex:/^(\+\d{1,3}[-\s]?)?\d{10}$/',
            'first_name' => 'required'
        ]);

        $user = new User;
        if ($user) {

            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->password = $req->pass;
            $user->phone_number = $req->mobile;
            $user->comm_address = $req->address;
            $user->gender = $req->gender;
            $user->city = $req->city;
            $user->DOB = $req->dob;
            $user->type_of_user = 'Normal';
            $user->save();

            $emp_id = DB::table('users')
            ->max('emp_id');
            
            return redirect()->back()->with('message', 'Registration Successful Your employee id is: ' .$emp_id);

            
        }
         else {
            return redirect()->back()->with('message', 'Issues with Registration ');
            
        }
    }
    

}
