<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    //delete the employee from database
    public function deleteEmp($id)
    {

        $del = DB::table('users')
            ->where('emp_id', $id)
            ->delete();
        if ($del) {
            return redirect()->back()->with('success', 'user deleted successfully');
        } else {
            return redirect()->back()->with('fail', 'could not delete');
        }
    }

    //add project to project table
    public function addProject(Request $req)
    {
        $req->validate([
            'project_name' => 'required',
            'project_desc' => 'required',
            'start_date' => 'required|before_or_equal:end_date',
            'end_date' => 'after_or_equal:start_date',
        ]);

        $project = new Project;
        $project->project_name = $req->project_name;
        $project->project_desc = $req->project_desc;
        $project->project_start_date = $req->start_date;
        $project->project_end_date = $req->end_date;
        $project->save();

        if ($project) {
            return redirect()->back()->with('message', 'Project Added Successfully');
        } else {
            return redirect()->back()->with('message', 'Some issues');
        }
    }

    //to get project details of specific employees
    public function getProjDetails($id)
    {
        $normalEmp = DB::table('users AS u')
            ->join('emp_proj AS ep', 'ep.emp_id', '=', 'u.emp_id')
            ->join('projects AS p', 'ep.project_id', '=', 'p.project_id')
            ->join('users AS u1', 'ep.manager_id', '=', 'u1.emp_id')
            ->select('p.project_id', 'ep.emp_id', 'ep.manager_id', 'u.type_of_user', 'u1.first_name', 'u1.last_name', 'p.project_name', 'p.project_desc')
            ->where('u.emp_id', '=', $id)
            ->get();

        $managerEmp = DB::table('users AS u')
            ->join('emp_proj AS ep', 'ep.manager_id', '=', 'u.emp_id')
            ->join('projects AS p', 'ep.project_id', '=', 'p.project_id')
            ->select('p.project_id', 'ep.emp_id', 'ep.manager_id', 'u.type_of_user', 'p.project_name', 'p.project_desc')
            ->where('u.emp_id', '=', $id)
            ->get();

        $array = ['normalEmp', 'managerEmp'];
        return view('displayProj', compact($array));
    }

    //get employee details of id
    public function getEmpDetails($id)
    {
        $res = DB::table('users')
            ->where('users.emp_id', '=', $id)
            ->get();
        return view('dispEmp', ['emp' => $res]);
    }

    //to update the status of an issue
    public function updateStatusOfIssues(Request $req)
    {
        $res = Issue::where('issue_id', "=", $req->id)
            ->update(['status' => $req->status]);

        if ($res) {
            return redirect()->back()->with('message', 'Issue Status Changed');
        } else {
            return redirect()->back()->with('message', 'Issue Status Changed');
        }
    }

    //to view all emp details
    public function showEmpDetailsToEdit($id)
    {
        $res = DB::table('users')
            ->where('users.emp_id', '=', $id)
            ->get();
        return view('editEmployee', ['emp' => $res]);
    }

    //display project details when clicked on view project
    public function showProjDetailsToEdit($id)
    {
        $res = DB::table('projects')
            ->where('projects.project_id', '=', $id)
            ->get();
        return view('editProject', ['proj' => $res]);
    }

    //update project details in admin page
    public function updateProjectDetails(Request $req)
    {
        $req->validate([
            'project_name' => 'required',
            'project_desc' => 'required',
            'project_start_date' => 'required|before_or_equal:project_end_date',
            'project_end_date' => 'after_or_equal:project_start_date',
        ]);

        $project = Project::where('project_id', '=', $req->project_id)
            ->update(
                [
                    'project_name' => $req->project_name,
                    'project_desc' => $req->project_desc,
                    'project_start_date' => $req->project_start_date,
                    'project_end_date' => $req->project_end_date,
                ]
            );

        if ($project) {
            return redirect()->back()->with('message', 'Data Edited Successfully');
        } else {
            return redirect()->back()->with('message', 'Data Edited Successfully');
        }
    }

    //update employee details in admin page
    public function updateEmpDetails(Request $req)
    {

        $user = User::where('emp_id', '=', $req->emp_id)
            ->update(
                [
                    'phone_number' => $req->phone_number,
                    'comm_address' => $req->comm_address,
                    'DOB' => $req->dob,
                    'gender' => $req->gender,
                    'city' => $req->city,
                    'type_of_user' => $req->type_of_user,
                    'password' => $req->password,
                ]
            );

        if ($user) {
            return redirect()->back()->with('message', 'Data Edited Successfully');
        } else {
            return redirect()->back()->with('message', 'Data Edited Successfully');
        }

    }

}
