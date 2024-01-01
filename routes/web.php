<?php


use Illuminate\Support\Facades\Route;


Route::group(['middleware' => []], __DIR__ . '/ImportingRoutes.php'); // * DONE 
Route::group(['middleware' => []], __DIR__ . '/RepRoutes.php');  // * DONE 
Route::group(['middleware' => []], __DIR__ . '/AuthRoutes.php');  // * DONE 
Route::group(['middleware' => []], __DIR__ . '/AdminRoutes.php');  // * DONE 
// Route::group(['middleware' => ['auth']], __DIR__ . '/utility.php');


Route::get('/', function () {
    return view('welcome');
})->name('home');
