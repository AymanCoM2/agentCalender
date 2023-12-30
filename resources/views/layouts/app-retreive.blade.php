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
    </script>
</body>

</html>
