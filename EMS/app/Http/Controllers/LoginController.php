<?php
namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    //user login page
    public function login(Request $req)
    {
        //validations
        $req->validate([
            'username' => 'required | max:10',
            'password' => 'required | min:4 max:10',
        ]);

        $id = $req->input('username');
        $password = $req->input('password');

        $data = User::where('emp_id', '=', $id)->first();

        $userdata = DB::table('users')
            ->where('emp_id', $id)
            ->get();

        if ($data) {

            if ($password == $data->password) {

                //by deciding the type of user we are deciding what data he will take into a userdashboard

                //NORMAL user
                if ($data->type_of_user == "Normal") {

                    $issues = DB::table('Issues')
                        ->where('emp_id', $data->emp_id)
                        ->select('issues.*')
                        ->get();

                    $array = ['userdata', 'issues'];

                    return view('userdashboard', compact($array));
                }

                //MANAGER user
                else if ($data->type_of_user == "Manager") {

                    $issues = DB::table('issues')
                        ->join('emp_issue', 'emp_issue.emp_id', '=', 'issues.emp_id')
                        ->where('manager_id', $data->emp_id)
                        ->select('issues.*')
                        ->groupBy('issues.issue_id')
                        ->get();

                    $projects = DB::table('projects')
                        ->join('emp_proj', 'emp_proj.project_id', '=', 'projects.project_id')
                        ->where('manager_id', $data->emp_id)
                        ->select('projects.*')
                        ->groupBy('projects.project_id')
                        ->get();

                    $users = DB::table('users')
                        ->join('emp_proj', 'emp_proj.emp_id', '=', 'users.emp_id')
                        ->where('manager_id', $data->emp_id)
                        ->select('users.*')
                        ->groupBy('users.emp_id')
                        ->get();

                    $array = ['userdata', 'users', 'issues', 'projects'];
                    return view('managerDashboard', compact($array));
                }
                //ADMIN user
                else if ($data->type_of_user == "Admin") {

                    $Users = User::all();
                    $projects = Project::all();
                    $issues = Issue::all();

                    $normalUsers = DB::table('users')
                        ->where('type_of_user', 'Normal')
                        ->get()
                        ->count();

                    $managers = DB::table('users')
                        ->where('type_of_user', 'Manager')
                        ->get()
                        ->count();

                    $NumberOfUsers = $normalUsers + $managers;

                    $array = ['Users', 'issues', 'projects','NumberOfUsers'];
                    return view('adminDashboard', compact($array));
                }

            } else {
                return back()->with('fail', 'Invalid Password');
            }

        } else {
            return back()->with('fail', 'Invalid Username');
        }
    }

}
