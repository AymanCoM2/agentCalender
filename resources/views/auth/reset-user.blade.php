<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fab.css') }}">

    <title>Create New User</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @guest
                        Guest
                    @endguest
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <form action="{{ route('logout') }}" method="post" id="littleForm">@csrf
                                        <a class="dropdown-item" href="#" id="loggingOut">Log Out</a>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @if (session()->has('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('reset-user-post') }}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 mx-auto mt-5">
                    <div id="form" class="p-4">
                        <div class="logo">
                            <h1 class="text-center head">Reset ({{ $chosenUser->name }})</h1>
                        </div>
                        <form method="POST" action="{{ route('reset-user-post') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $chosenUser->id }}">
                            <div class="form-item">
                                <label for="userCode">Code - Email For the User </label>
                                <input type="text" name="userCode" id="userCode" class="form-style" disabled
                                    autocomplete="off" value="{{ $chosenUser->userCode }}" />
                            </div>
                            <div class="form-item">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-style" />
                            </div>
                            <div class="form-item">
                                <label for="password">Repeat Password</label>
                                <input type="password" name="repassword" id="repassword" class="form-style" />
                            </div>
                            <div class="form-item">
                                <input type="submit" class="login btn btn-primary pull-right" value="Save">
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
