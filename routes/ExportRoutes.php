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


function getMonthDates($monthNumber)
{
    if ($monthNumber < 1 || $monthNumber > 12) {
        return false;
    }
    $currentYear = date('Y');
    $numDays = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $currentYear);
    $monthDates = [];
    for ($day = 1; $day <= $numDays; $day++) {
        $fullDate = sprintf('%04d-%02d-%02d', $currentYear, $monthNumber, $day);
        $monthDates[] = $fullDate;
    }
    return $monthDates; // ^ We need to Put 2 Other Columns , Name and COde
    // Insert Two Elements in the Array 
}



function sapDataForExport()
{
    $currentMonthNumber =  date('m'); // ! Will Be Input 
    $userAreaCode  = 'CS01'; // ! Will Be Input 
    $sampleSqlQuery  = "
        SELECT  'TM' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        TM.DBO.OCRD T0 LEFT JOIN TM.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        --WHERE T1.GroupName = '" . $userAreaCode . "'

        UNION ALL

        SELECT  'LB' 'COMP', T0.LicTradNum ,T1.GroupName,T0.CardName , T0.CardCode
        FROM 
        LB.DBO.OCRD T0 LEFT JOIN LB.DBO.OCRG T1 ON T0.GroupCode  = T1.GroupCode
        Order By T0.LicTradNum , T0.CardCode
        ";

    $serverName = "jou.is-by.us";
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









Route::get('/export-data', function () {
    dd(sapDataForExport());
    // Loop ,  TO Make Arrays and Collect Them  ; 
    // All Dates For this Month , && then Make Array With all Of them 
    // Customer Code  , Customer Name  ,  

    $list = collect([
        [
            'CardCode' => "vvv",
            'Customer Name' => "Dummy Name",
            '01-01-2024' => "x",
        ],
        [
            'CardCode' => "sgrf",
            'Customer Name' => "sfgwrg Name",
            '01-01-2024' => "-",
        ]
    ]);

    // (new FastExcel($list))->export('file.xlsx');

})->name('export-data');
