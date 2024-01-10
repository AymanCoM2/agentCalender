<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastify.min.css') }}">
    <title>All Users</title>
</head>

<style>
</style>

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
    <br>
    <a href="{{ route('create-user-get') }}" class="btn btn-primary mx-5">+Create New User</a>
    <br>
    <div class="container">
        <table class="table table-responsive w-100 text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">UserHandle</th>
                    <th scope="col">Area Code</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allReps as $rep)
                    <tr>
                        <td class="p-2">{{ $rep->name }}</td>
                        <td class="p-2">{{ $rep->userCode }}</td>
                        <td class="p-2">{{ $rep->areaCode }}</td>
                        <td class="p-2">
                            <a href="{{ route('reset-user-get', $rep->id) }}">Reset Password</a>
                            <br>
                            @if (\App\Models\User::find($rep->id)->monthapproval()->where('month', '01')->where('year', '2024')->first())
                                @if (\App\Models\User::find($rep->id)->monthapproval()->where('month', '01')->where('year', '2024')->first()->isApproved)
                                @else
                                    <a href="{{ route('retreive-rep-calender', $rep->id) }}">Approve Month Calender</a>
                                @endif
                            @else
                                <a href="{{ route('retreive-rep-calender', $rep->id) }}">Approve Month Calender</a>
                            @endif
                            <br>
                            <a href="{{ route('retreive-calender-get-cust', $rep->id) }}">Cust Month Calender</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toastify-js.js') }}"></script>
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
