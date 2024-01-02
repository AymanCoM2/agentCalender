<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;


Route::group(['middleware' => ['needLog', 'normalAdmin']], __DIR__ . '/ImportingRoutes.php'); // * DONE 
Route::group(['middleware' => ['needLog', 'representative']], __DIR__ . '/RepRoutes.php');  // * DONE 
Route::group(['middleware' => ['needLog']], __DIR__ . '/AuthRoutes.php');  // * DONE 
Route::group(['middleware' => ['needLog', 'normalAdmin']], __DIR__ . '/AdminRoutes.php');  // * DONE 
// Route::group(['middleware' => ['auth']], __DIR__ . '/utility.php');

Route::get('/login', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->userType === 'normalAdmin') {
            return redirect()->route('admin-home');
        } else if ($user->userType === 'rep') {
            return redirect()->route('rep-home');
        } else if ($user->userType === 'superAdmin') {
            return redirect()->route('home');
        }
    }
    return view('auth.login-page');
})->name("login-get");

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'userCode' => ['required'],
        'password' => ['required'],
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->userType === 'normalAdmin') {
            return redirect()->route('admin-home');
        } else if ($user->userType === 'rep') {
            return redirect()->route('rep-home');
        } else if ($user->userType === 'superAdmin') {
            return redirect()->route('home'); // ! TODO 
        }
    }
    return back()->withErrors(['email' => 'The credentials do not match records.']);
})->name("login-post");


Route::get('/', function () {
    return redirect()->route('login-get');
})->name('home');
