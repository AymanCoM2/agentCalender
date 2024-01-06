<?php

use App\Models\Client;
use App\Models\DailyProgress;
use App\Models\MonthApproval;
use App\Models\MonthPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function establishConnectionDB($inputQuery)
{
    $serverName = "jou.is-by.us";
    $databaseName = "TM";
    $uid = "ayman";
    $pwd = "admin@1234";
    $port = "445";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        "TrustServerCertificate" => true,
    ];
    $conn = new PDO("sqlsrv:server=$serverName,$port; Database = $databaseName;", $uid, $pwd, $options);
    $stmt = $conn->query($inputQuery);
    $conn = null;
    return $stmt;
}

function getMonthDatesWithNames($monthNumber)
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
    $weeks = [
        'week_1' => [],
        'week_2' => [],
        'week_3' => [],
        'week_4' => [],
        'week_5' => [],
    ];
    foreach ($monthArray as $date => $day) {
        $dayOfWeek = date('w', strtotime($date));
        $weekIndex = ceil(date('j', strtotime($date)) / 7);
        $weekIndex = min($weekIndex, 5);
        $weeks["week_$weekIndex"][$date] = $day;
    }
    return $weeks;
}

Route::get('rep-home', function () {
    $currentMonthNumber =  date('m');
    $canFillCalender  = true;
    $currentYear = date('Y');
    $userId = Auth::user()->id;
    $approvalObject  = MonthApproval::where('month', $currentMonthNumber)
        ->where('year', $currentYear)
        ->where('user_id', $userId)
        ->first();
    if ($approvalObject) {
        if ($approvalObject->isApproved) {
            $canFillCalender  = false;
        }
    }
    return view('rep-home', compact('canFillCalender'));
})->name('rep-home'); // !@ DONE 

Route::get('/fill-calender', function () {
    $currentMonthNumber =  date('m');
    $userAreaCode  = Auth::user()->areaCode;
    $sampleSqlQuery  = "
        SELECT 'TM' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        TM.DBO.OCRD T0 LEFT JOIN TM.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        --WHERE T1.GroupName = '" . $userAreaCode . "'

        UNION ALL

        SELECT 'LB' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        LB.DBO.OCRD T0 LEFT JOIN LB.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        Order By T0.LicTradNum , T0.CardCode
        ";

    // $sampleSqlQuery  = "
    //     SELECT T1.GroupName,T0.CardName , T0.CardCode
    //     FROM
    //     OCRD T0 LEFT JOIN OCRG T1 ON T0.GroupCode  = T1.GroupCode
    //     WHERE T1.GroupName = '" . $userAreaCode . "'
    //     ";
    $statement  = establishConnectionDB($sampleSqlQuery);
    $clientsDataArrray  = [];
    while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        $clientsDataArrray[] = $row;
    }
    $daysArray = getMonthDatesWithNames($currentMonthNumber);
    $weeksArray = cutMonthArrayIntoWeeks($daysArray);
    $matchingMonthPlan  = MonthPlan::where('user_id', Auth::user()->id)->where('month', $currentMonthNumber)->get();
    return view('fill-calender', compact(['weeksArray', 'clientsDataArrray', 'matchingMonthPlan']));
})->name('fill-calender-get')->middleware('alreadyApproved'); // !@DONE 

Route::post("/post-cell-data", function (Request $request) {
    $currentMonthNumber =  date('m');
    $symbol  = $request->symbol;
    $date =  $request->dateOfTask;
    $month =  $currentMonthNumber;
    $cardCode =  $request->cardCode;
    $repId  =  $request->repId;
    $doesPlanExist = MonthPlan::where('cardCode', $cardCode)->where('date', $date)->where('user_id', Auth::user()->id)->first();
    if ($doesPlanExist) {
        $doesPlanExist->month = $month;
        $doesPlanExist->year =  date('Y');
        $doesPlanExist->date = $date;
        $doesPlanExist->user_id = Auth::user()->id;
        $doesPlanExist->state = $symbol;
        $doesPlanExist->cardCode = $cardCode;
        $doesPlanExist->save();
        return response()->json(['key' => "Just-Updated"]);
    } else {
        $newPlanObject = new MonthPlan();
        $newPlanObject->month = $month;
        $newPlanObject->year =  date('Y');
        $newPlanObject->date = $date;
        $newPlanObject->user_id = Auth::user()->id;
        $newPlanObject->state = $symbol;
        $newPlanObject->cardCode = $cardCode;
        $newPlanObject->save();
        return response()->json(['key' => "Newly-Created"]);
    }
})->name('post-cell-data'); // !@DONE 

Route::get('/record-one-day', function () {
    $currentMonthNumber =  date('m');
    $todaysDate  = date('Y-m-d');
    // $todaysDate  = "2024-01-02";
    $currentYear  = date('Y');
    $userAreaCode  = Auth::user()->areaCode;
    $sampleSqlQuery  = "
        SELECT 'TM' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        TM.DBO.OCRD T0 LEFT JOIN TM.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        --WHERE T1.GroupName = '" . $userAreaCode . "'

        UNION ALL

        SELECT 'LB' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        LB.DBO.OCRD T0 LEFT JOIN LB.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        Order By T0.LicTradNum , T0.CardCode
        ";
    // $sampleSqlQuery  = "
    //     SELECT T1.GroupName,T0.CardName , T0.CardCode
    //     FROM
    //     OCRD T0 LEFT JOIN OCRG T1 ON T0.GroupCode  = T1.GroupCode
    //     WHERE T1.GroupName = '" . $userAreaCode . "'
    //     ";
    $statement  = establishConnectionDB($sampleSqlQuery);
    $clientsDataArrray  = [];
    while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        $clientsDataArrray[] = $row;
    }
    $dailyProgressRecord  = DailyProgress::where('user_id', Auth::user()->id)->where('date', $todaysDate)->get();
    return view('one-day-calender', compact(['clientsDataArrray', 'dailyProgressRecord', 'todaysDate', 'currentMonthNumber']));
})->name('record-one-d-get'); // !@DONE 

Route::post('/record-one-day', function (Request $request) {
    $currentMonthNumber =  date('m');
    $todaysDate  = date('Y-m-d');
    $currentYear  = date('Y');
    $symbol  = $request->symbol;
    $date =  $todaysDate;
    $month =  $currentMonthNumber;
    $cardCode =  $request->cardCode;
    $repId  =  $request->repId;
    $doesDailyExist = DailyProgress::where('cardCode', $cardCode)->where('date', $date)->where('user_id', Auth::user()->id)->first();
    if ($doesDailyExist) {
        $doesDailyExist->month = $month;
        $doesDailyExist->year =  date('Y');
        $doesDailyExist->date = $date;
        $doesDailyExist->user_id = Auth::user()->id;
        $doesDailyExist->state = $symbol;
        $doesDailyExist->cardCode = $cardCode;
        $doesDailyExist->save();
        return response()->json(['key' => "Just-Updated"]);
    } else {
        $newDailyObject = new DailyProgress();
        $newDailyObject->month = $month;
        $newDailyObject->year =  date('Y');
        $newDailyObject->date = $date;
        $newDailyObject->user_id = Auth::user()->id;
        $newDailyObject->state = $symbol;
        $newDailyObject->cardCode = $cardCode;
        $newDailyObject->save();
        return response()->json(['key' => "Newly-Created"]);
    }
})->name('record-one-d-post'); // !@DONE 


Route::post('/add-new-client', function (Request $request) {
    $request->validate([
        'clientName' => ['required'],
    ]);

    $clientName  = $request->clientName;
    $notes  = $request->notes;
    $repId  = Auth::user()->id;

    $newlyCreatedClient  = new Client();
    $newlyCreatedClient->client_name  = $clientName;
    $newlyCreatedClient->rep_id = $repId;
    // $newlyCreatedClient->notes  = $notes; // !@ TODO , Uncomment in Next Fresh Migration
    $newlyCreatedClient->save();
    return redirect()->route('rep-home')->with(['msg' => 'Client Is added ']);
})->name('add-new-client');
