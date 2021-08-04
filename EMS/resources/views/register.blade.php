<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title>User Registration</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {
        height: 80%;
        padding-bottom: 120px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center">
    <x-header />

    <div class="card text-center">
        <div class="card-header"></div>
        <div class="card-body">
            <h5 class="card-title">Registration Form</h5>
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
           
        </div>
    </div><br>

    <form action="register" method="POST" class="d-flex flex-column items-center needs-validation" novalidate>
        <!-- Registration Form -->
        @csrf
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="first_name" name="first_name" class="form-control" required />
                    <label class="form-label">First name</label>
                    <div class="invalid-feedback">
                        Please provide first name correctly
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="last_name" name="last_name" class="form-control" required />
                    <label class="form-label">Last name</label>
                    <div class="invalid-feedback">
                        Please provide last name correctly
                    </div>
                </div>
            </div>
        </div>

        <span style = "color:red">
                    @error('mobile')
                    {{$message}}
                    @enderror
        </span>

        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="mobile" name="mobile" class="form-control" required />
                    <label class="form-label" for="form3Example1">Mobile</label>
                    <div class="invalid-feedback">
                        Please provide a valid mobile number
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="date" id="dob" name="dob" class="form-control" / required>
                    <label class="form-label" for="form3Example2">Date of Birth</label>
                    <div class="invalid-feedback">
                        Please provide your DOB
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <input type="password" id="pass" name="pass" class="form-control" title="Atleast 5 letters"
                        required />
                    <label class="form-label" for="form3Example2">Password</label>
                    <div class="invalid-feedback">
                        Please provide a password
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="password" id="pass1" name="conf-pass" class="form-control" required />
                    <label class="form-label" for="form3Example2">Confirm Password</label>
                    <div class="invalid-feedback">
                        Please re-type your password correctly
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <div class="form-outline justify-between">
                    <input type="text" id="address" name="address" class="form-control" required />
                    <label class="form-label" for="address">Address</label>
                    <div class="invalid-feedback">
                        Please provide a valid address
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="form-check-inline" name="gender">   

                    <input class="form-check-input mr-2" type="radio" name="gender" value="male" id="gendercheck">
                    <label class="form-check-label mr-2" for="flexCheckDefault">
                        Male
                    </label>

                    <input class="form-check-input mr-2" type="radio" name="gender" value="female" id="gendercheck">
                    <label class="form-check-label mr-2" for="flexCheckDefault">
                        Female
                    </label>

                    <input class="form-check-input" type="radio" value="" name="gender" value="other"
                        id="gendercheck">
                    <label class="form-check-label" for="flexCheckDefault">
                        Other
                    </label>

                </div>
            </div>

        </div>


        <div class="row mb-4">
            <div class="col">
                <div class="dropdown">
                    <select name="city" class="btn btn-secondary dropdown-toggle" required>
                        <option value="" disabled selected>Select City</option>
                        <option value="Bangalore">Bangalore</option>
                        <option value="Pune">Pune</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Mumbai">Mumbai</option>
                    </select>
                    <div class="invalid-feedback">
                        Please choose a city
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- Simple link -->
            <a class="ml-3 p-2" href="/forgotPass">Forgot password?</a>
        </div>
        </div>

        <button type="submit" value="Submit" onclick="validate_checkbox(event);validate_password(event);"
            class="btn btn-primary mt-3">Register</button>
    </form>

    <script>
    function validate_password(event) {
        var pass = document.getElementById('pass').value;
        var pass1 = document.getElementById('pass1').value;

        if ((pass != pass1) || pass == NULL || pass1 == NULL) {
            alert("Please Check your Password, make sure you re-type correctly");
            event.preventDefault();
        }

    }

    function validate_checkbox(event) {
        var checkboxes = document.getElementsByName('gender');
        var checked = 0;
        var checked_count = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checked = 1;
                checked_count++;
            }
        }
        if (!checked) {
            alert("Please Select a gender");
            event.preventDefault();
        }
        if(checked_count > 1){
            alert("Please Select a single gender option only");
            event.preventDefault();
        }
    }


    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>

    <x-footer />

</body>

</html>