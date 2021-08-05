<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssueController extends Controller
{

    //to create new issue in all user pages
    public function submitIssue(Request $req)
    {

        $req->validate([

            'emp_id' => 'required',
           'issue_type' => 'required',
            'issue_desc' => 'required',
        ]);

        $issue = new issue;
        $issue->emp_id = $req->emp_id;
        $issue->issue_type = $req->issue_type;
        $issue->issue_desc = $req->issue_desc;
        $issue->status = "pending";
        $issue->save();

        //Fetch the lastest issue
        $curr_issue_id = DB::table('issues')
        ->where('emp_id', '=', $req->emp_id)
        ->max('issue_id');

        $curr_issue = DB::table('issues')
        ->where('issue_id', '=', $curr_issue_id)
        ->get();

        //Fetch Manager Id
        $mg_id = DB::table('emp_proj')
        ->select('manager_id')
        ->where('emp_id', '=', $req->emp_id)
        ->get();
        
        //assigning the issue to respective managers
        foreach ($mg_id as $mg) {
            $final_mg_id = $mg->manager_id;
            DB::table('emp_issue')
            ->insert(
                ['emp_id' => $req->emp_id, 
                'issue_id' => $curr_issue_id, 
                'manager_id' => $final_mg_id]
            );
        }

        if ($issue) {
            return redirect()->back()->with('message', 'Issue Submitted Successfully');
        } else {
            return redirect()->back()->with('message', 'Issue Not Submitted');
        }
    }

}
