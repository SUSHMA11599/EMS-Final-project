<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> Normal User </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {
        height: 100%;
    }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center">
    <x-normaluser />

    <div class="card text-center">
        <div class="card-header"></div>
        <div class="card-body">
            @foreach($userdata as $user)
            <h5 class="card-title">Welcome, {{$user->first_name ." ". $user->last_name}}</h5>
            @endforeach
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
     
        </div>
    </div>

    <table class="table w-75">
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
                <a href="" data-toggle="modal" data-target="#editModal">Edit Details</a>
            </td>
        </tr>
        @endforeach
    </table><br>
    
  
    <br><table class="table w-50">
        <thread>
            <tr>
                <th>Issue type</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thread>
       
        @foreach($issues as $i)
        <tr>
            <td>{{ $i->issue_type }}</td>
            <td>{{ $i->issue_desc}}</td>
            <td>{{ $i->status }}</td>           

        </tr>
        @endforeach
    </table><br>

    <div class="d-flex flex-column">
      <h5>You may raise an issue here</h5>
      <form action="issue" method="GET">
          @csrf
          <div class="">
              <div class="form-group">
                  <input type="number" class="form-control" name="emp_id" value="{{ $user->emp_id }}" hidden>
                  <input type="text" class="form-control mb-2" name="issue_type" placeholder="Issue type" required/>
                  <input type="text" class="form-control mb-2" name="issue_desc" placeholder="Issue description" required/>
                  <button type="submit" class="btn btn-warning w-100">Submit Issue</button>
                  <br>
              </div>
          </div>
      </form>
    </div>


    <x-footer />

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mobileModalLabel">Edit User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-outline">

                        <form action="updateMobile" method="post">
                            @csrf

                            <div class="form-group">
                                <h5>Update mobile number</h5>
                                <input type="text" class="form-control" name="emp_id" value="{{ $user->emp_id }}" hidden>
                                <input type="number" class="form-control" name="newMobileNumber"
                                    placeholder="New Mobile Number" required/>

                                  <button type="button" class="btn btn-secondary p-2 m-2" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary p-2 m-2">Save changes</button>
                        </form>
                    </div>

                    <div class="form-outline">

                        <form action="updateAddress" method="post">
                            @csrf

                            <div class="form-group">
                                <h5>Update User Address</h5>

                                <input type="number" class="form-control" name="emp_id" value="{{ $user->emp_id }}" hidden>
                                <input type="text" class="form-control" name="newAddress" placeholder="New Address" required/>

                                  <button type="button" class="btn btn-secondary p-2 m-2" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary p-2 m-2">Save changes</button>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>



</body>

</html>