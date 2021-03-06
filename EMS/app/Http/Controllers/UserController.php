<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    //all users can update mobile number 
    public function updateMobile(Request $req)
    {
        $user = User::where('emp_id', $req->emp_id)->update(array('phone_number' => $req->newMobileNumber));
        if ($user > 0) {
            return redirect()->back()->with('message', 'Mobile Number Updated');
        }
    }

    //all users can update address
    public function updateAddress(Request $req)
    {
        $user = User::where('emp_id', $req->emp_id)->update(array('comm_address' => $req->newAddress));
        if ($user != 0) {
            return redirect()->back()->with('message', 'Address updated');
        }
    }

   
}
