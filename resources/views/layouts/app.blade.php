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
    <div class="container m-4">
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script>
        let dayCells = document.querySelectorAll(".inner_cell");
        // let symbolObject = {
        //   X: "target",
        //   O: "onrandom",
        //   F: "failed",
        //   P: "planned",
        //   N: "new",
        //   _: "_",
        // };
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
                    url: "{{ route('post-cell-data') }}",
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
                            text: data,
                            duration: 3000,
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            },
                        }).showToast();
                    },
                    error: function(e) {
                        Toastify({
                            text: e,
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
                        currentSymbol = "X"; // Clear the cell
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
                    case "X":
                        currentSymbol = "O"; // Clear the cell
                        eachCell.style.backgroundColor = "Orange";
                        eachCell.dataset.currentSymbol = currentSymbol;
                        saveCellData(
                            currentSymbol,
                            taskDate,
                            taskMonth,
                            cardCode,
                            repId
                        );
                        break;
                    case "O":
                        currentSymbol = "F"; // Change to "F" on the next click
                        eachCell.style.backgroundColor = "red";
                        eachCell.dataset.currentSymbol = currentSymbol;
                        saveCellData(
                            currentSymbol,
                            taskDate,
                            taskMonth,
                            cardCode,
                            repId
                        );
                        break;
                    case "F":
                        currentSymbol = "P"; // Change to "P" on the next click
                        eachCell.style.backgroundColor = "green";
                        eachCell.dataset.currentSymbol = currentSymbol;
                        saveCellData(
                            currentSymbol,
                            taskDate,
                            taskMonth,
                            cardCode,
                            repId
                        );
                        break;
                    case "P":
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
</body>

</html>
