<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> Project Details </title>
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
    <h5>Following are the details of the Employee's Project/Projects</h5>
    <table class="table w-75">
        <thread>
        <tr>
            <th>Employee id</th>
            <th>Project id</th>
            <th>Manager id</th>
            <th>Manager name</th>
            <th>Project name</th>
            <th>Project description</th>
        </tr>
        </thread>

        @foreach($normalEmp as $user)
        <tr>
            <td>{{ $user->emp_id }}</td>
            <td>{{ $user->project_id }}</td>
            <td>{{ $user->manager_id}}</td>
            <td>{{ $user->first_name ." ". $user->last_name}}</a></td>
            <td>{{ $user->project_name }}</td>
            <td>{{ $user->project_desc }}</td>
            @endforeach
        </tr>

        @foreach($managerEmp as $user)
        <tr>
            <td>{{ $user->manager_id}}</td>
            <td>{{ $user->project_id }}</td>
            <td>{{ $user->manager_id}}</td>
            <td>null</td>
            <td>{{ $user->project_name }}</td>
            <td>{{ $user->project_desc }}</td>
        </tr>
        @endforeach

    </table>


    <x-footer />
</body>
</html>