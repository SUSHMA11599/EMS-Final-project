<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    //
    public function getData(Request $req)
    {
        $req->validate([
            'username' => 'required | max:10',
            'new_password' => 'required | min:4 ',
            'confirm_password' => 'required | same:new_password',
        ]);
        return $req->input();
    }

    public function show(Request $req)
    {
        return DB::select("select * from users;");
    }

    public function updatePassword(Request $req)
    {
        $req->validate([
            'username' => 'required | max:10',
            'new_password' => 'required | min:4 max:10',
            'confirm_password' => 'required | same:new_password',
        ]);

        $id = $req->input('username');

        $data = DB::table('users')
            ->where('emp_id', $id)
            ->first();

        if ($data) {

            $password = $req->input('new_password');

            DB::update('update users set password=? where emp_id = ?', [$password, $id]);
            return back()->with('success', 'yay!!! password updated');

        } else {
            return back()->with('error', 'Opps!!! Username not Found');
        }

    }
}