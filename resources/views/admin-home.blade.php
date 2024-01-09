<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fab.css') }}">
    <title>Admin Home Page</title>
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
                                <li><a class="dropdown-item" href="#">30 Month View</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
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
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12 mx-auto mt-5">
                <div id="form" class="p-4">
                    <div class="logo">
                        <h1 class="text-center head">Admin</h1>
                    </div>
                    <div class="form-item">
                        <a href="{{ route('list-all-users') }}"
                            class="form-style btn btn-primary rounded-pill px-3 w-100">List all Users</a>
                    </div>

                    <div class="form-item">
                        <a href="{{ route('create-user-get') }}"
                            class="form-style btn btn-primary rounded-pill px-3 w-100">Create New User</a>
                    </div>

                    <div class="form-item">
                        <a href="{{ route('import-reps-get') }}"
                            class="form-style btn btn-primary rounded-pill px-3 w-100">Import Excel File</a>
                    </div>

                    <hr>
                    <div class="form-item">
                        <a href="{{ route('view-daily-progress') }}"
                            class="form-style btn btn-info rounded-pill px-3 w-100">View Daily Progress</a>
                    </div>
                    <hr><br>
                    <div class="form-item">
                        <a href="{{ route('import-reps-get') }}"
                            class="form-style btn btn-warning rounded-pill px-3 w-100">Merge a New Client</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        let loggoutBtn = document.getElementById("loggingOut");
        let loggoutForm = document.getElementById("littleForm");
        loggoutBtn.addEventListener('click', function(eventos) {
            eventos.preventDefault();
            loggoutForm.submit();
        });
    </script>
</body>

</html>
