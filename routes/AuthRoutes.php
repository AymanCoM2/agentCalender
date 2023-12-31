<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

// *================================================================>>
Route::get('/login', function () {
    return view('auth.login-page');
})->name("login-get");
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'userCode' => ['required'],
        'password' => ['required'],
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('home');
    }
    return back()->withErrors(['email' => 'The credentials do not match records.']);
})->name("login-post");
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login-get');
})->name('logout');
// *================================================================>>
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
        return redirect()->back();
    }
})->name('create-user-post');
// *================================================================>>
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
            return redirect()->route('home');
        } else {
            dd("Error"); // abort() ; 
        }
    } else {
        return redirect()->back();
    }
})->name('reset-user-post');
