<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

Route::get('/import-reps', function (Request $request) {
    return view('import-reps');
})->name('import-reps-get');

Route::post('/import-reps', function (Request $request) {
    $collections = (new FastExcel)->import($request->excelFile);
    Schema::disableForeignKeyConstraints();
    DB::table('users')->truncate();
    Schema::enableForeignKeyConstraints();
    foreach ($collections as $collection) {
        $nu = new User();
        $nu->name  = $collection['Name'];
        $nu->userCode  = $collection['Email'];
        $nu->areaCode  = $collection['Code'];
        $nu->password  = Hash::make('123');
        $nu->pass_as_string  = '123';
        $nu->save();
    }
    session()->flash('message', 'File successfully Uploaded.');
    return back();
})->name('import-reps-post');

//*===========================================================>>
