<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fab.css') }}">
    <title>Rep Home Page</title>
</head>

<body>
    {{-- START OF NAV BAR --}}
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
    {{-- END OF NAV BAR --}}
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
                        <h1 class="text-center head">Welcome</h1>
                    </div>
                    <div class="form-item">
                        <a href="{{ route('fill-calender-get') }}"
                            class="form-style btn btn-primary rounded-pill px-3 w-100">
                            {{ $canFillCalender ? 'Fill Current Month Plan' : '✅Plan Approved' }}
                        </a>
                    </div>
                    <div class="form-item">
                        <a href="{{ route('record-one-d-get') }}"
                            class="form-style btn btn-warning rounded-pill px-3 w-100">Fill Today
                            Progress</a>
                    </div>
                    <hr><br>
                    <div class="form-item">
                        <a href="{{ route('fill-calender-get-cust') }}"
                            class="form-style btn btn-info rounded-pill px-3 w-100">Fill Current
                            Month Plan(New Client)</a>
                    </div>

                    <div class="form-item">
                        <a href="{{ route('record-one-d-get-cust') }}"
                            class="form-style btn btn-info rounded-pill px-3 w-100">Fill Today
                            Progress(New Client)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- START OF FAB --}}
    <div id="container-floating" data-bs-toggle="modal" data-bs-target="#addClientModal">
        <div id="floating-button">
            <p class="plus">+</p>
            <img class="edit" src="{{ asset('img/bt_compose2_1x.png') }}">
        </div>
    </div>
    {{-- END OF FAB --}}
    <!-- Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addClientModalLabel">Add New Client</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('add-new-client') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="clientName" class="form-label">Client Name:</label>
                            <input type="text" class="form-control" id="clientName" name="clientName">
                            <div id="" class="form-text">*Client Name is Required</div>
                        </div>

                        <div class="mb-3">
                            <label for="Noets" class="form-label">Notes:</label>
                            <textarea name="notes" id="" rows="3" class="w-100 form-control"></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
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
