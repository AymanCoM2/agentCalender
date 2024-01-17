<?php

use App\Models\Client;
use App\Models\CustDailyProgress;
use App\Models\CustMonthApproval;
use App\Models\CustMonthPlan;
use App\Models\DailyProgress;
use App\Models\MonthApproval;
use App\Models\MonthPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

function getMonthDates($monthNumber, $yearNumber)
{
    if ($monthNumber < 1 || $monthNumber > 12) {
        return false;
    }
    $currentYear = $yearNumber;
    $numDays = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $currentYear);
    $monthDates = [];
    for ($day = 1; $day <= $numDays; $day++) {
        $fullDate = sprintf('%04d-%02d-%02d', $currentYear, $monthNumber, $day);
        $monthDates[] = $fullDate;
    }
    return $monthDates;
}

function sapDataForExport($userAreaCode)
{
    $sampleSqlQuery  = "
        SELECT 'TM' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        TM.DBO.OCRD T0 LEFT JOIN TM.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        WHERE T1.GroupName = '" . $userAreaCode . "'

        UNION ALL

        SELECT 'LB' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        LB.DBO.OCRD T0 LEFT JOIN LB.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        WHERE T1.GroupName = '" . $userAreaCode . "'
        Order By T0.LicTradNum , T0.CardCode
        ";

    $serverName = "jdry1.ifrserp.net";
    $databaseName = "TM";
    $uid = "ayman";
    $pwd = "admin@1234";
    $port = "445";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        "TrustServerCertificate" => true,
    ];
    $conn = new PDO("sqlsrv:server=$serverName,$port; Database = $databaseName;", $uid, $pwd, $options);
    $stmt = $conn->query($sampleSqlQuery);
    $conn = null;
    $clientsDataArrray  = [];
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $clientsDataArrray[] = $row;
    }
    return $clientsDataArrray;
}


Route::get('/export-data', function (Request $request) {
    $allReps  = User::where('userType', 'rep')->get();
    $allYears  = MonthPlan::groupBy('year')->pluck('year')->toArray();
    return view('export-page-get', compact(['allReps', 'allYears']));
})->name('export-data'); // * OK 

Route::post('/export-data-post', function (Request $request) {
    $request->validate([
        'selected_rep' => ['required'],
        'selected_month' => ['required'],
        'selected_year' => ['required'],
    ]);
    $userAreaCode = User::find($request->selected_rep)->areaCode;
    $userName = User::find($request->selected_rep)->name;
    $motherArray  = [];
    $keysArray = getMonthDates($request->selected_month, $request->selected_year);
    $sapData  = sapDataForExport($userAreaCode);
    foreach ($sapData as $eachClient) {
        $childArray = [];
        $childArray['Client Code'] = $eachClient->CardCode;
        $childArray['Client Name'] = $eachClient->CardName;
        $childArray['Company'] = $eachClient->COMP;
        foreach ($keysArray as $dateKey) {
            $status = "-";
            $dateState =  MonthPlan::where('user_id', $request->selected_rep)
                ->where('month', $request->selected_month)
                ->where('date', $dateKey)
                ->where('cardCode', $eachClient->CardCode)
                ->where('company', $eachClient->COMP)
                ->first();
            if ($dateState) {
                $status = $dateState->state;
            }
            $childArray[$dateKey] = $status;
        }
        $motherArray[] = $childArray;
    }
    $list = collect($motherArray);
    $finalFileName  = $request->selected_year . "_" . $userName . "_" . $userAreaCode . "." . "_" . $request->selected_month . ".xlsx";
    return (new FastExcel($list))->download($finalFileName);
})->name('export-post');
