<?php

use App\Models\Dummy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/record-one', function () {
    return view('one-day-calender');
})->name('record-one-d-get');

Route::post('/record-one', function () {
    // ! PASS 
})->name('record-one-d-post');
//*===========================================================>>

Route::get('rep-home', function () {
    return view('rep-home');
})->name('rep-home');
