<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> Employee Management System </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Dosis:400,600' rel='stylesheet' type='text/css'>
    <style>
        body {
            height: 80%;
            padding-bottom: 70px;
        }

        #members {
            display: none;
        }
    </style>

</head>

<body class="d-flex flex-column h-100 row align-items-center" onload="typeWriter()">
    <x-header />

    <div class="d-flex">

        <div class="d-flex m-4 p-4 text-center">

            <h2 id="dstxt" style="color:#0080FF;"> </h2>

        </div>


    </div>



    <div id="members" calss="h2 m-4 p-4">

        <h2 id="inner">
            Created by<br>
                Shubham,<br>
                Sushma G,<br>
                Gayatri.<br>
        </h2>

                <img src="/images/emslogo.jpeg">

    </div>

    <x-footer />
    <script>

        var i = 0;
        var txt = 'Welcome to Employee Management System';
        var speed = 60;

        function typeWriter() {
            if (i < txt.length) {
                document.getElementById("dstxt").innerHTML += txt.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            }
            if (i == txt.length) {
                $("#members").fadeIn("slow");
            }

        }
    </script>
</body>

</html>