<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-around">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link">USER</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{URL::to(route('screen_home'))}}">Home</a>
        </li>
    </ul>

    <ul class="navbar-nav">
        @if (Auth::check() && Auth::user()->role->name === Config::get('auth.roles.user'))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    {{auth()->user()->name}}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{URL::to(route('logout'))}}">
                        Logout
                    </a>
                </div>
            </li>
        @else
            <li class="nav-item dropdown">
                <a class="nav-link " href="{{URL::to(route('screen_login'))}}">
                    Login
                </a>
            </li>
        @endif
    </ul>

</nav>

<div class="container bg-light">
    {{-- start content --}}
    @yield('user_content')
    {{-- end content --}}
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
