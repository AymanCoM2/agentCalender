<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastify.min.css') }}">
    <title>App</title>
</head>

<style>
    thead {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 3;
        background: white;
        border: 1px solid black;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg fixed-bottom navbar-light bg-light">
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
                        <li class="nav-item dropup">
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
                        <li class="nav-item dropup">
                            <a class="nav-link dropdown-toggle btn btn-danger" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ?
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <img src="{{ asset('img/colorMap.png') }}" alt="">
                                </li>

                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container m-4">
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script>
        let dayCells = document.querySelectorAll(".inner_cell");

        dayCells.forEach((eachCell) => {
            let currentSymbol = eachCell.dataset.currentSymbo;
            switch (currentSymbol) {
                case "_":
                case "X":
                    eachCell.style.backgroundColor = "white";
                    break;
                case "O":
                    eachCell.style.backgroundColor = "Orange";
                    break;
                case "F":
                    eachCell.style.backgroundColor = "red";
                    break;
                case "P":
                    eachCell.style.backgroundColor = "green";
                    break;
                case "N":
                    eachCell.style.backgroundColor = "blue";
                    break;
                default:
                    break;
            }
        });

        dayCells.forEach((eachCell) => {
            let currentSymbol = eachCell.dataset.currentSymbo;
            let taskDate = eachCell.dataset.taskDate;
            let taskMonth = eachCell.dataset.taskMonth;
            let cardCode = eachCell.dataset.cardCode;
            let repId = eachCell.dataset.repId;

            function saveCellData(
                _symbolState,
                _taskDate,
                _taskMonth,
                _cardCode,
                _repId
            ) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                }); // Setting Up the Ajax # 1

                $.ajax({
                    type: "POST",
                    url: "{{ route('record-one-d-post-cust') }}",
                    data: {
                        symbol: _symbolState,
                        dateOfTask: _taskDate,
                        monthOfTask: _taskMonth,
                        cardCode: _cardCode,
                        repId: _repId,
                    },
                    success: function(data) {
                        console.log(data);
                        Toastify({
                            text: "✔️",
                            duration: 300,
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            },
                        }).showToast();
                    },
                    error: function(e) {
                        Toastify({
                            text: "Error !",
                            duration: 3000,
                            style: {
                                background: "linear-gradient(to left, #563474, #96c93d)",
                            },
                        }).showToast();
                        console.log(e);
                    }, // End of Error Option
                }); // End Of Ajax call
            }

            eachCell.addEventListener("click", function() {
                // Toggle through symbols
                switch (currentSymbol) {
                    case "_":
                        currentSymbol = "N"; // Change to "N" on the next click
                        eachCell.style.backgroundColor = "blue";
                        eachCell.dataset.currentSymbol = currentSymbol;
                        saveCellData(
                            currentSymbol,
                            taskDate,
                            taskMonth,
                            cardCode,
                            repId
                        );
                        break;
                    case "N":
                        currentSymbol = "_"; // Change to "" (clear) on the next click
                        eachCell.style.backgroundColor = "white";
                        eachCell.dataset.currentSymbol = currentSymbol;
                        saveCellData(
                            currentSymbol,
                            taskDate,
                            taskMonth,
                            cardCode,
                            repId
                        );
                        break;
                    default:
                        break;
                }
                if (currentSymbol) {
                    eachCell.innerText = currentSymbol;
                }
            });
        });
    </script>
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
