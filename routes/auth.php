<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Auth::routes(['verify' => true]);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');

Route::middleware('guest')->group(function(){

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');


    Route::prefix('/register')->name('register.')->group(function () {
        Route::get('/client', function () {
            return view('auth.types.client');
        })->name('client');

        Route::get('/workshop', function () {
            return view('auth.types.workshop');
        })->name('workshop');

        Route::get('/diagnostician', function () {
            return view('auth.types.diagnostician');
        })->name('diagnostician');

        Route::post('/client', [\App\Http\Controllers\Auth\RegisterController::class, 'registerClient'])
            ->name('client.post');
        Route::post('/workshop', [\App\Http\Controllers\Auth\RegisterController::class, 'registerWorkshop'])
            ->name('workshop.post');
    });

});

