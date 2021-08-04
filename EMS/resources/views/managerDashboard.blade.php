<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> Manager User </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {
        height: 80%;
        padding-bottom: 70px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center mt-auto">
    <x-managerheader /><br>
    <div class="card text-center">
        <div class="card-header"></div>
        <div class="card-body">
            @foreach($userdata as $user)
            <h5 class="card-title">Welcome, {{$user->first_name ." ". $user->last_name}} ( {{$user->type_of_user}} )
            </h5>
            @endforeach

            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif

            <h5 id="topdetail" class="mt-3 p-2">
                Personal Details
            </h5>

        </div>
    </div>

    <table class="table w-75 mx-auto" id="personaldetails">
        <thread>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Password</th>
                <th>Mobile Number</th>
                <th>Date Of Birth</th>
                <th>Communication Address</th>
                <th>Gender</th>
                <th>City</th>
                <th>Operation</th>
            </tr>
        </thread>
        @foreach($userdata as $user)
        <tr>
            <td>{{ $user->emp_id }}</td>
            <td>{{ $user->first_name ." ". $user->last_name}}</td>
            <td>{{ $user->password }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->DOB }}</td>
            <td>{{ $user->comm_address }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->city }}</td>
            <td>
                <a href="" data-toggle="modal" data-target="#editModal" onclick="hide_section2()">Edit Details</a>
            </td>

        </tr>
        @endforeach
    </table>


    <table class="table w-75 mx-auto" id="issues" hidden>

        <thread>
            <tr>
                <th>Raised by (ID) </th>
                <th>Type </th>
                <th>Description </th>
                <th>Status </th>
            </tr>
        </thread>
        @foreach($issues as $i)

        <tr>
            <td>{{ $i->emp_id }}</td>
            <td>{{ $i->issue_type }}</td>
            <td>{{ $i->issue_desc}}</td>
            <td>{{ $i->status }}</td>
            
        @endforeach
    </table>


    <table class="table w-75 mx-auto" id ="projects" hidden>
    <!-- <h5 class="mt-2 mt-3 mb-3">Projects </h5> -->

        <thread>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Project Description </th>
                <th>Project Start Date</th>
                <th>Project End Date </th>
                <th>
                    <a href="" data-toggle="modal" data-target="#editModal" onclick="hide_section1()">Add/Remove</a>
                </td>
            </tr>
        </thread>
        @foreach($projects as $p)
        <tr>
            <td>{{ $p->project_id }}</td>
            <td>{{ $p->project_name}}</td>
            <td>{{ $p->project_desc }}</td>
            <td>{{ $p->project_start_date }}</td>
            <td>{{ $p->project_end_date }}</td>

            @endforeach

            
    </table>
    <!-- Reportees -->

    <table class="table w-75 mx-auto" id="reportees" hidden>

        <thread>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Date Of Birth</th>
                <th>Communication Address</th>
                <th>Gender</th>
                <th>City</th>
                </td>
            </tr>
        </thread>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->emp_id }}</td>
            <td>{{ $user->first_name ." ". $user->last_name}}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->DOB }}</td>
            <td>{{ $user->comm_address }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->city }}</td>

        </tr>
        @endforeach

    </table>


    <!-- Issues Raising -->

        <div class="d-flex flex-column">

            <form action="issue" method="GET" id="raiseissue" hidden>
            <h5>You may raise an issue here</h5>

                @csrf
                        <input type="number" class="form-control" name="emp_id" value="{{ $user->emp_id }}" hidden>
                        <input type="text" class="form-control mb-2" name="issue_type" placeholder="Enter issue type"
                            required />
                        <input type="text" class="form-control mb-2" name="issue_desc"
                            placeholder="Enter issue description" required />
                        <button type="submit" class="btn btn-warning w-100">Submit Issue</button>
            </form>
        </div>

    <!-- </div> -->



    <x-footer />

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallabel">Change Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Section 1 -->
                    <div class="form-outline" id="updatemobile">

                        <form action="updateMobile" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form1heading"> Update mobile number</h5>
                                <input type="text" id="form1input1" class="form-control" name="emp_id"
                                    value="{{ $user->emp_id }}" hidden />
                                <input type="number" id="form1input2" class="form-control" name="newMobileNumber"
                                    placeholder="New Mobile Number" required />

                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Save changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="form-outline" id="updateaddress">

                        <form id="form2" action="updateAddress" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form2heading">Update User Address</h5>

                                <input type="number" id="form2input1" class="form-control" name="emp_id"
                                    value="{{ $user->emp_id }}" hidden />
                                <input type="text" id="form2input2" class="form-control" name="newAddress"
                                    placeholder="New Address" required />


                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- These below modals are for Adding or Deleting the Data from Projects for a Manager -->

                    <!-- Section 2 -->
                    <div class="form-outline" id="addusertoproject">

                        <form action="addEmp" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form2heading">Add User to a Project</h5>

                                <input type="number" class="form-control" name="manager_id" value="{{ $user->emp_id }}"
                                    hidden />
                                <input type="text" class="form-control mb-2" name="emp_id"
                                    placeholder="Employee ID" required />
                                <input type="number" class="form-control" name="proj_id"
                                    placeholder="Project ID" required />

                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Add User</button>
                            </div>
                        </form>
                    </div>

                    <div class="form-outline" id="deleteuserfromproject">

                        <form action="deleteEmp" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form2heading">Remove User from a Project</h5>

                                <input type="number" class="form-control" name="manager_id" value="{{ $user->emp_id }}"
                                    hidden />
                                <input type="number" class="form-control mb-2" name="emp_id"
                                    placeholder="Employee ID to delete" required />
                                <input type="number" class="form-control" name="proj_id" placeholder="Project ID"
                                    required />

                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Remove User</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <script>

    function hide_section2() {
        var section1div1 = document.getElementById("updatemobile");
        var section1div2 = document.getElementById("updateaddress");
        var modalheading = document.getElementById("modallabel");
      
        modalheading.innerHTML = "Change Details";

        //If section is hidden make it visible

        section1div1.removeAttribute("hidden");
        section1div2.removeAttribute("hidden");
        //Hide Section 2 

        var section2div1 = document.getElementById("addusertoproject");
        var section2div2 = document.getElementById('deleteuserfromproject');

        section2div1.setAttribute("hidden", "");
        section2div2.setAttribute("hidden", "");
    }

    function hide_section1() {
        var section1div1 = document.getElementById("updatemobile");
        var section1div2 = document.getElementById("updateaddress");
        var modalheading = document.getElementById("modallabel");
     

        modalheading.innerHTML = "Add/Remove Reportees";

        var section2div1 = document.getElementById("addusertoproject");
        var section2div2 = document.getElementById('deleteuserfromproject');

        //Hide Section 1
        section1div1.setAttribute("hidden", "");
        section1div2.setAttribute("hidden", "");
        //Unhide Section 2
        section2div1.removeAttribute("hidden");
        section2div2.removeAttribute("hidden");
    }

    var details = document.getElementById('topdetail');

    function showpersonaldetails(){
        var personaldetails = document.getElementById("personaldetails");
        var issues          = document.getElementById('issues');
        var projects        = document.getElementById('projects');
        var reportees       = document.getElementById('reportees');
        var issueform       = document.getElementById('raiseissue');
       
        details.innerHTML = "Personal Details";


        personaldetails.removeAttribute("hidden");
        issues.setAttribute("hidden","");
        projects.setAttribute("hidden","");       
        reportees.setAttribute("hidden","");       
        issueform.setAttribute("hidden","");

    }

    function showreportees(){
        var personaldetails = document.getElementById("personaldetails");
        var issues          = document.getElementById('issues');
        var projects        = document.getElementById('projects');
        var reportees       = document.getElementById('reportees');
        var issueform       = document.getElementById('raiseissue');
        
        details.innerHTML = "Reportees";

        reportees.removeAttribute("hidden");       

        issues.setAttribute("hidden","");
        projects.setAttribute("hidden",""); 
        issueform.setAttribute("hidden","");
        personaldetails.setAttribute("hidden","");

    }

    function showprojects(){
        var personaldetails = document.getElementById("personaldetails");
        var issues          = document.getElementById('issues');
        var projects        = document.getElementById('projects');
        var reportees       = document.getElementById('reportees');
        var issueform       = document.getElementById('raiseissue');

        details.innerHTML = "Your Projects";

        projects.removeAttribute("hidden");

        reportees.setAttribute("hidden","");       
        issues.setAttribute("hidden","");
        issueform.setAttribute("hidden","");
        personaldetails.setAttribute("hidden","");

    }

    function reporteeissues(){
        var personaldetails = document.getElementById("personaldetails");
        var issues          = document.getElementById('issues');
        var projects        = document.getElementById('projects');
        var reportees       = document.getElementById('reportees');
        var issueform       = document.getElementById('raiseissue');

        details.innerHTML = "Issues by Reportees";


        issues.removeAttribute("hidden");

        projects.setAttribute("hidden","");
        reportees.setAttribute("hidden","");       
        issueform.setAttribute("hidden","");
        personaldetails.setAttribute("hidden","");

    }

    function raiseissuse(){
        var personaldetails = document.getElementById("personaldetails");
        var issues          = document.getElementById('issues');
        var projects        = document.getElementById('projects');
        var reportees       = document.getElementById('reportees');
        var issueform       = document.getElementById('raiseissue');

        details.innerHTML = "Raise an Issue";


        issueform.removeAttribute("hidden");

        issues.setAttribute("hidden","");
        projects.setAttribute("hidden","");
        reportees.setAttribute("hidden","");       
        personaldetails.setAttribute("hidden","");
    }

    </script>

</body>

</html>