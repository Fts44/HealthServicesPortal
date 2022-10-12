<?php

use Illuminate\Support\Facades\Route;


Route::get('/noaccess', function(){
    return view('Errors.NoAccess');
})->name('NoAccess');


use App\Http\Controllers\OTPController as OTP;

// ================== Authentication  ===================
use App\Http\Controllers\Authentication\LoginController as Login;
use App\Http\Controllers\Authentication\RegisterController as Register;
use App\Http\Controllers\Authentication\RecoverController as Recover;

Route::get('/logout', [Login::class, 'logout'])->name('Logout');
Route::post('/otp', [OTP::class, 'compose_mail'])->name('SendOTP');

Route::middleware('IsLoggedIn')->group(function(){

    Route::prefix('/')->group(function(){
        Route::get('', [Login::class, 'index'])->name('LoginIndex');
        Route::post('login', [Login::class, 'login'])->name('Login');
    });

    Route::prefix('/register')->group(function(){
        Route::get('', [Register::class, 'index'])->name('RegisterIndex');
        Route::post('register', [Register::class, 'register'])->name('Register');
    });

    Route::prefix('/recover')->group(function(){
        Route::get('', [Recover::class, 'index'])->name('RecoverIndex');
        Route::post('recover', [Recover::class, 'recover'])->name('Recover');
    });
});
// ================= Authentication ======================

