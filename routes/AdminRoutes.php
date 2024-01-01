<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\MonthPlan;
use Illuminate\Http\Request;


function establishConnectionDB_web($inputQuery)
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

function getMonthDatesWithNames_web($monthNumber)
{
    // This Function Gets The Month Number [ 12 For December ]
    // And Then Return Associative array [ Key is the Date & Value is the Name "ie : sat"]
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

function cutMonthArrayIntoWeeks_web($monthArray)
{
    // This function takes the month array and Split it Into Weeks 
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
        // Get the week index based on the day of the month
        $weekIndex = ceil(date('j', strtotime($date)) / 7);
        // If the week index is greater than 5, put it in week 5
        $weekIndex = min($weekIndex, 5);
        // Add the date to the corresponding week
        $weeks["week_$weekIndex"][$date] = $day;
    }

    return $weeks;
}

Route::get('list-all-users', function () {
    $allReps  = User::where('userType', 'rep')->get();
    return view('all-users', compact('allReps'));
})->name('list-all-users');

Route::get('/retreive-rep-calender/{rep_id}', function (Request $request) {
    $repId  = $request->rep_id;
    $currentMonthNumber =  date('m'); // To seach For the Approval Model 

    $repUserObject  = User::find($repId);
    $sampleSqlQuery  = "
        SELECT T1.GroupName,T0.CardName , T0.CardCode
        FROM
        OCRD T0 LEFT JOIN OCRG T1 ON T0.GroupCode  = T1.GroupCode
        WHERE T1.GroupName = '" . $repUserObject->areaCode . "'
        ";
    $statement  = establishConnectionDB_web($sampleSqlQuery);
    $clientsDataArrray  = [];
    while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        $clientsDataArrray[] = $row;
    }
    $daysArray = getMonthDatesWithNames_web($currentMonthNumber);
    $weeksArray = cutMonthArrayIntoWeeks_web($daysArray);
    $matchingDummies  = MonthPlan::where('user_id', $repId)->where('month', $currentMonthNumber)->get();
    return view('retreive-calender', compact(['weeksArray', 'clientsDataArrray', 'matchingDummies']));
})->name('retreive-rep-calender');
