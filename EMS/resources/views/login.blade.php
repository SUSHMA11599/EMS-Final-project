<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title> User Login </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            height: 100%;
            }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center">
    <x-header/>


    <div class="mx-auto align-items items-center" class="col-lg-3">
            
        <div class="card text-center">
            <div class="card-header"></div>
            <div class="card-body">
                <h5 class="card-title">User Login</h5>
            </div>
        </div>  

       
         <form action="{{route('login-user')}}" method="GET">
             @if(Session::has('success'))
             <div class="alert alert-success">{{session::get('success')}}</div>
             @endif
             @if(Session::has('fail'))
             <div class="alert alert-danger">{{session::get('fail')}}</div>
             @endif

             @csrf
               <div class="form-group">
                   <label for="">Employee Id</label><br>
                   <input type="number" class="form-control"  name="username" placeholder= "Employee Id">
                  
                   <span style = "color:red">
                    @error('username')
                    {{$message}}
                    @enderror
                </span>
            
               </div>
               <div class="form-group">
                   <label for="">Password</label><br>
                   <input type="password" class="form-control" name="password" placeholder="Password">
              
                   <span style = "color:red">
                    @error('password')
                    {{$message}}
                    @enderror
                </span>
               </div>
            <div class="d-flex flex-column items-center mx-auto justify-center">
                <a href="forgotPass">Forgot Password ?</a>
                <a href="register">Sign Up</a><br>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>      
         </form>
    </div>
    <x-footer/>
</body>
</html>