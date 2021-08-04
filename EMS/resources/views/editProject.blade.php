<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> Edit Project details </title>
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
    <h4>Update Project Details</h4>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="d-flex align-items">
        <form action="updateProjectDetails" method="POST">
            {{method_field('PUT')}}
            @csrf
            <div class="d-flex flex-column ">
                <div class="">
                    @foreach ($proj as $item)
                    <label class="m-2" for="">Project Id</label>
                    <input type="number" class="form-control" name="project_id" value="{{ $item->project_id }}"
                        readonly />

                    <label class="m-2" for="">Project Name</label>
                    <input type="text" class="form-control" name="project_name" value="{{ $item->project_name }}">

                    <label class="m-2" for="">Project Description</label>
                    <textarea type="text" class="form-control" name="project_desc">{{ $item->project_desc }}</textarea>

                    <label class="m-2" for="">Project Start Date</label>
                    <input type="date" class="form-control" name="project_start_date"
                        value="{{ $item->project_start_date }}">


                    <label class="m-2" for="">Project End Date</label>
                    <input type="date" class="form-control" name="project_end_date"
                        value="{{ $item->project_end_date }}">
                        <span style="color:red">
                            @error('project_end_date')
                            {{$message}}
                            @enderror
                        </span><br>
                            @endforeach

                    <button class="btn btn-primary mt-3 p-2 w-100" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>

    <x-footer />

</body>

</html>