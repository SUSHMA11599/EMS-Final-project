<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> User Details </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {
        height: 80%;
        padding-bottom: 70px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center">
    <x-plainheader />

    <!-- to display all personal data of specific employee-->
    <h5>Following are the details of the Employee</h5>

    <table class="table w-75">
    <thread>
    <tr> 
        <th>Employee ID</th>
        <th>Employee Name</th>
        <th>Mobile Number</th>
        <th>Date Of Birth</th>
        <th>Communication Address</th>
        <th>Gender</th>
        <th>City</th>   
        <th>Type of Employee</th>   
    </tr>
</thread>
    @foreach($emp as $user)
    @if($user->type_of_user != 'Admin')        
        <tr>
            <td>{{ $user->emp_id }}</td>
            <td>{{ $user->first_name.' '.$user->last_name }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->DOB }}</td>
            <td>{{ $user->comm_address }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->city }}</td>   
            <td>{{ $user->type_of_user }}</td>  
        </tr>
    @endif
    @endforeach 

</table>

    <x-footer/>
</body>

</html>