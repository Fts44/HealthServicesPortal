<?php

use Illuminate\Support\Facades\Route;

Route::get('/noaccess', function(){
    return view('Errors.NoAccess');
})->name('NoAccess');

// ================== Authentication  ===================
use App\Http\Controllers\Authentication\LoginController as Login;
use App\Http\Controllers\Authentication\RegisterController as Register;
use App\Http\Controllers\Authentication\RecoverController as Recover;

Route::middleware('IsLoggedIn')->group(function(){

    Route::prefix('/')->group(function(){
        Route::get('/', [Login::class, 'index'])->name('LoginIndex');
    });

    Route::prefix('/register')->group(function(){
        Route::get('/', [Register::class, 'index'])->name('RegisterIndex');
    });

    Route::prefix('/recover')->group(function(){
        Route::get('/', [Recover::class, 'index'])->name('RecoverIndex');
    });
});
// ================= Authentication ======================

