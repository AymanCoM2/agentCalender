<?php

use App\Models\Client;
use App\Models\CustDailyProgress;
use App\Models\CustMonthPlan;
use App\Models\DailyProgress;
use App\Models\MonthApproval;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;
use App\Models\MonthPlan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

function establishConnectionDB_web($inputQuery)
{
    $serverName = "jou.is-by.us";
    $databaseName = "LB";
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
function getMonthDatesWithNames_web($monthNumber)
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
function cutMonthArrayIntoWeeks_web($monthArray)
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

Route::get('/admin-home', function () {
    return view('admin-home');
})->name('admin-home');

Route::get('list-all-users', function () {
    $allReps  = User::where('userType', 'rep')->get();
    return view('all-users', compact('allReps'));
})->name('list-all-users');

Route::get('/retreive-rep-calender/{rep_id}', function (Request $request) {
    $repId  = $request->rep_id;
    $currentMonthNumber =  date('m'); // To seach For the Approval Model 
    $repUserObject  = User::find($repId);
    $sampleSqlQuery  = "
        SELECT 'TM' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        TM.DBO.OCRD T0 LEFT JOIN TM.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        --WHERE T1.GroupName = '" .  $repUserObject->areaCode . "'

        UNION ALL

        SELECT 'LB' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        LB.DBO.OCRD T0 LEFT JOIN LB.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        Order By T0.LicTradNum , T0.CardCode
        ";
    $statement  = establishConnectionDB_web($sampleSqlQuery);
    $clientsDataArrray  = [];
    while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        $clientsDataArrray[] = $row;
    }
    $daysArray = getMonthDatesWithNames_web($currentMonthNumber);
    $weeksArray = cutMonthArrayIntoWeeks_web($daysArray);
    $matchingDummies  = MonthPlan::where('user_id', $repId)->where('month', $currentMonthNumber)->get();
    return view('retreive-calender', compact(['weeksArray', 'clientsDataArrray', 'matchingDummies', 'repId']));
})->name('retreive-rep-calender');

Route::get('/create-user',  function () {
    return view('auth.create-user');
})->name('create-user-get');

Route::post('/create-user', function (Request $request) {
    $request->validate([
        'userCode' => ['required'],
        'password' => ['required'],
        'repassword' => ['required'],
    ]);
    if ($request->password == $request->repassword) {
        $newUser = new User();
        $newUser->name  = $request->name;
        $newUser->userCode  = $request->userCode;
        $newUser->password  = Hash::make($request->password);
        $newUser->save();
        return redirect()->route('home');
    } else {
        return redirect()->back()->with(['msg' => 'User Created']);
    }
})->name('create-user-post');

Route::get('/reset-user/{user_id}',  function (Request $request) {
    $userId  = $request->user_id;
    $chosenUser  = User::find($userId);
    if ($chosenUser) {
        return view('auth.reset-user', compact('chosenUser'));
    } else {
        dd("Error"); // abort() ; 
    }
})->name('reset-user-get');

Route::post('/reset-user', function (Request $request) {
    $userId  = $request->user_id;
    $request->validate([
        'password' => ['required'],
        'repassword' => ['required'],
    ]);
    if ($request->password == $request->repassword) {
        $chosenUser  = User::find($userId);
        if ($chosenUser) {
            $chosenUser->password  = Hash::make($request->password);
            $chosenUser->save();
            return redirect()->route('admin-home')->with(['msg' => 'User Password is Reset']);
        } else {
            dd("Error"); // abort() ; 
        }
    } else {
        return redirect()->back()->with(['msg' => 'ERROR : Passwords Not Matching !!!']);
    }
})->name('reset-user-post');

Route::get('/approve-rep-plan/{repId}', function (Request $request) {
    $rep_id  = $request->repId;
    $currentMonthNumber =  date('m');
    $currentYear = date('Y');
    $approvalObject  = MonthApproval::where('month', $currentMonthNumber)
        ->where('year', $currentYear)
        ->where('user_id', $rep_id)
        ->first();
    if ($approvalObject) {
        $approvalObject->isApproved = true;
        $approvalObject->save();
    } else {
        $approvalObject  = new MonthApproval();
        $approvalObject->month = $currentMonthNumber;
        $approvalObject->year = $currentYear;
        $approvalObject->isApproved = true;
        $approvalObject->user_id = $rep_id;
        $approvalObject->save();
    }
    return redirect()->back()->with(['msg' => 'Approved Plan']);
})->name('approve-rep-plan');

Route::get('/view-daily-progress', function (Request $request) {
    $allReps  = User::where('userType', 'rep')->get();
    $todaysDate =  date('Y-m-d');
    $clientsDataArrrayCust = null;
    $clientsDataArrray = null;
    $dailyProgressRecord = null;
    $dailyProgressRecordCust = null;
    $currentMonthNumber =  date('m');
    $todaysDate  = date('Y-m-d');
    $currentYear  = date('Y');

    if ($request->selected_date) {
        $todaysDate = $request->selected_date;
        if ($request->selected_rep) {
            $repUser = User::find($request->selected_rep);
            // ^ First Getting Custom Daily Progress
            $userAreaCode  = $repUser->areaCode;
            $clientsDataArrrayCust  = Client::where('rep_id', $repUser->id)->get(); // use Get to Get a Collection Array
            $dailyProgressRecordCust  = CustDailyProgress::where('user_id', $repUser->id)->where('date', $todaysDate)->get();

            // & Now the Other Daily Progres 
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
            $statement  = establishConnectionDB_web($sampleSqlQuery);
            $clientsDataArrray  = [];
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $clientsDataArrray[] = $row;
            }
            $dailyProgressRecord  = DailyProgress::where('user_id', $repUser->id)->where('date', $todaysDate)->get();
            return view('admin-view-daily', compact(['allReps', 'todaysDate', 'clientsDataArrrayCust', 'dailyProgressRecordCust', 'todaysDate', 'currentMonthNumber', 'clientsDataArrray', 'dailyProgressRecord']));
        } else {
            return view('admin-view-daily', compact(['allReps', 'todaysDate', 'clientsDataArrrayCust', 'dailyProgressRecordCust', 'todaysDate', 'currentMonthNumber', 'clientsDataArrray', 'dailyProgressRecord']))->with(['msg' => 'Error Loading Data!']);
        }
    } else {
        if ($request->selected_rep) {
            $repUser = User::find($request->selected_rep);
            // ^ First Getting Custom Daily Progress

            $userAreaCode  = $repUser->areaCode;
            $clientsDataArrrayCust  = Client::where('rep_id', $repUser->id)->get(); // use Get to Get a Collection Array
            $dailyProgressRecordCust  = CustDailyProgress::where('user_id', $repUser->id)->where('date', $todaysDate)->get();

            // & Now the Other Daily Progres 
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
            $statement  = establishConnectionDB_web($sampleSqlQuery);
            $clientsDataArrray  = [];
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $clientsDataArrray[] = $row;
            }
            $dailyProgressRecord  = DailyProgress::where('user_id', $repUser->id)->where('date', $todaysDate)->get();
            return view('admin-view-daily', compact(['allReps', 'todaysDate', 'clientsDataArrrayCust', 'dailyProgressRecordCust', 'todaysDate', 'currentMonthNumber', 'clientsDataArrray', 'dailyProgressRecord']));
        } else {
            return view('admin-view-daily', compact(['allReps', 'todaysDate', 'clientsDataArrrayCust', 'dailyProgressRecordCust', 'todaysDate', 'currentMonthNumber', 'clientsDataArrray', 'dailyProgressRecord']))->with(['msg' => 'Error Loading Data!']);
        }
    }
})->name('view-daily-progress');

// ----------------
Route::get('/retreive-calender-cust/{rep_id}', function (Request $request) {
    $currentMonthNumber =  date('m');
    $user = User::find($request->rep_id);
    $repId  = $request->rep_id;
    $userAreaCode  = $user->areaCode;
    $clientsDataArrray  = Client::where('rep_id', $user->id)->get(); // use Get to Get a Collection Array
    $daysArray = getMonthDatesWithNames_web($currentMonthNumber);
    $weeksArray = cutMonthArrayIntoWeeks_web($daysArray);
    $matchingDummies  = CustMonthPlan::where('user_id', $user->id)->where('month', $currentMonthNumber)->get(); // TODO  : This Needs To be Changed To "Cust Month Plan " 
    return view('retreive-calender-cust', compact(['weeksArray', 'clientsDataArrray', 'matchingDummies', 'currentMonthNumber', 'repId']));
})->name('retreive-calender-get-cust')->middleware('alreadyApproved'); // !@DONE 


Route::post('/merge-post', function (Request $request) {
    $request->validate([
        'sapCode' => ['required'],
    ]);
    $cardCode = $request->sapCode;
    $theEntryId  = $request->theId;
    $toBeMerged = CustMonthPlan::where('cardCode', $theEntryId)->get();

    foreach ($toBeMerged as $eachRecord) {
        $mp = new MonthPlan();
        $mp->month  = $eachRecord->month;
        $mp->year  = $eachRecord->year;
        $mp->date  = $eachRecord->date;
        $mp->cardCode  = $cardCode; // ! This is the Important Part 
        $mp->user_id  = $eachRecord->user_id;
        $mp->state   = $eachRecord->state;
        $mp->save();
        $eachRecord->delete();
    }
    $theClient = Client::find($theEntryId);
    $theClient->delete();
    return redirect()->back();
})->name('merge-post');
