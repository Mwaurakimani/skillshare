<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- end scripts -->

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <link rel="stylesheet" href="{{ asset("css/Assets/app.css") }}">
    <!-- end css -->

    <title>Document</title>
</head>

<body>
<nav>
    <div class="logo_holder">
        <div class="img_holder">
            <img src=" {{ asset('storage/Logo_red.png') }} " alt="" onclick="window.location.href='/'">
        </div>
    </div>
    <div class="navigation_links">
        <ul>
            <li>
                <a href="/Contractors">Contractors</a>
            </li>
            <li>
                <a href="/Projects">Projects</a>
            </li>
        </ul>
    </div>
    <div class="user_action">
        @if( Auth::user() == null)
            <div class="button_holder">
                <a href="/register" >Register</a>
            </div>
        @else
            <div class="button_holder">
                <a href="/logout" >Log out</a>
            </div>
        @endif
    </div>
</nav>
@yield('content')

<!-- script -->

<script data-main="libs/js/main.js" src=" {{ asset('js/res/live.js') }} "></script>

<!-- end script -->
</body>

</html>
