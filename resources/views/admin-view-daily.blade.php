<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fab.css') }}">
    <title>Daily Progress</title>
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

    <div class="container">
        @if (session()->has('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <br>
        <form action="" method="get">
            <div class="row">
                <div class="col-5">
                    <select class="form-select" aria-label="" name="selected_rep">
                        <option selected value="">Select User</option>
                        @foreach ($allReps as $rep)
                            <option value="{{ $rep->id }}"
                                {{ Request::input('selected_rep') == $rep->id ? 'selected' : '' }}>{{ $rep->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-5">
                    <input type="date" name="selected_date" value="{{ $todaysDate }}" class="form-control">
                </div>

                <div class="col-2">
                    <input type="submit" class="btn btn-success rounded-pill">
                </div>
            </div>
        </form>
        <br>
        {{-- IF daily Progress Sent ? Render it  --}}
    </div>

    <div class="container">
        <div class="row">
            @if ($clientsDataArrrayCust != null)
                <div class="col-6">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Client Name</th>
                                <th scope="col" colspan="">Day</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>{{ $todaysDate }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientsDataArrrayCust as $eachClient)
                                <tr>
                                    <td>{{ $eachClient->client_name }}</td>
                                    <td>
                                        @php
                                            $matchingDateForClient = null;
                                            foreach ($dailyProgressRecordCust as $singleProgressRecord) {
                                                if ($singleProgressRecord->cardCode == $eachClient->id) {
                                                    $matchingDateForClient = $singleProgressRecord;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <div class="inner_cell"
                                            data-current-symbo="{{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}"
                                            data-task-date="{{ $todaysDate }}"
                                            data-task-month="{{ $currentMonthNumber }}"
                                            data-card-code="{{ $eachClient->id }}"
                                            data-rep-id="{{ Auth::user()->id }}">
                                            {{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if ($clientsDataArrray != null)
                <div class="col-6">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Client Code</th>
                                <th scope="col">Client Name</th>
                                <th scope="col" colspan="">Day</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{{ $todaysDate }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientsDataArrray as $eachClient)
                                <tr>
                                    <td>{{ $eachClient->CardCode }}</td>
                                    <td>{{ $eachClient->CardName }}</td>
                                    <td>
                                        @php
                                            $matchingDateForClient = null;
                                            foreach ($dailyProgressRecord as $singleProgressRecord) {
                                                if ($singleProgressRecord->cardCode == $eachClient->CardCode) {
                                                    $matchingDateForClient = $singleProgressRecord;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <div class="inner_cell"
                                            data-current-symbo="{{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}"
                                            data-task-date="{{ $todaysDate }}"
                                            data-task-month="{{ $currentMonthNumber }}"
                                            data-card-code="{{ $eachClient->CardCode }}"
                                            data-rep-id="{{ Auth::user()->id }}">
                                            {{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
