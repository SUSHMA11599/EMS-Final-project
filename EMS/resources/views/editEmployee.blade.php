<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> Edit employee details </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {
        height: 80%;
        padding-bottom: 90px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center">
    <x-plainheader />
<!-- form to edit details of employee -->
    <h4>Employee details</h4>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @foreach ($emp as $item)
    <div class="d-flex align-items">

        <form action="updateEmpDet" method="post" class="d-flex-inline">
            {{method_field('PUT')}}
            @csrf
            <label class="mb-2 mt-2" for="">Employee Id</label>
            <input type="number" class="form-control" name="emp_id" value="{{ $item->emp_id }}" readonly>

            <label class="mb-2 mt-2" for="">Phone Number</label>
            <input type="number" class="form-control" name="phone_number" value="{{ $item->phone_number }}">

            <label class="mb-2 mt-2" for="">Communication Address</label>
            <input type="text" class="form-control" name="comm_address" value="{{ $item->comm_address }}">

            <label class="mb-2 mt-2" for="">Password</label>
            <input type="text" class="form-control" name="password" value="{{ $item->password }}">

            <label class="mb-2 mt-2" for="">Date of Birth</label>
            <input type="date" class="form-control" name="dob" value="{{ $item->DOB}}">

            <label class="mb-2 mt-2" for="">Gender</label>
            <input type="text" class="form-control" name="gender" value="{{ $item->gender }}">

            <label class="mb-2 mt-2" for="">City</label>
            <input type="text" class="form-control" name="city" value="{{ $item->city }}">

            <label class="mb-2 mt-2" for="">Type of User</label><br>
            <input type="text" class="form-control" name="type_of_user" value="{{ $item->type_of_user }}" readonly>

                <select id="statusUpdate" class="btn btn-secondary dropdown-toggle" name="type_of_user">
                    <option value="" disabled selected>Select</option>
                    <option value="Manager">Manager</option>
                    <option value="Admin">Admin</option>
                </select>

            <button type="submit" class="btn btn-primary w-100 mt-3">Update</button>

        </form>

    </div>
    @endforeach
    <x-footer />
</body>
</html>