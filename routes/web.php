<?php

use Illuminate\Support\Facades\Route;

function getMonthDatesWithName($monthNumber)
{
    if ($monthNumber < 1 || $monthNumber > 12) {
        return false;
    }
    $currentYear = date('Y');
    $numDays = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $currentYear);
    $monthDatesWithNames = [];
    for ($day = 1; $day <= $numDays; $day++) {
        $fullDate = sprintf('%04d-%02d-%02d', $currentYear, $monthNumber, $day);
        $date = new DateTime($fullDate);
        $dayName = $date->format('D');
        $monthDatesWithNames[$fullDate] = $dayName;
    }
    return $monthDatesWithNames;
}


function cutMonthArrayIntoWeeks($monthArray)
{
    // Define the weeks
    $weeks = [
        'week_1' => [],
        'week_2' => [],
        'week_3' => [],
        'week_4' => [],
        'week_5' => [],
    ];

    // Iterate through the days and distribute them into weeks
    foreach ($monthArray as $date => $day) {
        // Get the day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
        $dayOfWeek = date('w', strtotime($date));

        // Calculate the week index
        $weekIndex = intval(($dayOfWeek + date('j', strtotime($date)) - 1) / 7) + 1;

        // If the week index is greater than 5, put it in week 5
        $weekIndex = min($weekIndex, 5);

        // Add the date to the corresponding week
        $weeks["week_$weekIndex"][$date] = $day;
    }

    return $weeks;
}
function establishConnectionDB($inputQuery)
{
    $serverName = "jou.is-by.us";
    $databaseName = "LB";
    $uid = "ayman";
    $pwd = "admin@1234";
    $port = "443";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        "TrustServerCertificate" => true,
    ];
    $conn = new PDO("sqlsrv:server=$serverName,$port; Database = $databaseName;", $uid, $pwd, $options);
    $stmt = $conn->query($inputQuery);
    $conn = null;
    return $stmt;
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fill-calender', function () {
    $sampleSqlQuery  = "
        SELECT T0.CardName , T0.CardCode
        FROM 
        LB.DBO.OCRD T0 LEFT JOIN OCRG T1 ON T0.GroupCode  = T1.GroupCode
        WHERE T0.GroupCode = '115'
        ";
    $statement  = establishConnectionDB($sampleSqlQuery);
    $clientsDataArrray  = [];
    while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        $clientsDataArrray[] = $row;
    }
    // Making Connection For Customers
    $daysArray = getMonthDatesWithName(12);
    // dd($daysArray);
    // dd($clientsDataArrray);
    $weeko = cutMonthArrayIntoWeeks($daysArray);
    dd($weeko);
    // Checking How Many Weeks We Have 
    // Checking How Many Days 
    return view('fill-calender');
})->name('fill-calender-get');
