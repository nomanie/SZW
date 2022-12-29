<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MustResetPasswordMiddleware;

Auth::routes(['verify' => true]);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');
Route::middleware(MustResetPasswordMiddleware::class)->get('/change-password', function () {
   return view('auth.change_password');
})->name('change_password');
Route::middleware(MustResetPasswordMiddleware::class)->post('/change-password', [\App\Http\Controllers\Auth\RegisterController::class, 'changePassword'])->name('change_password.post');

Route::middleware('guest')->group(function(){

    Route::get('/login', function () {
        Auth::viaRemember();
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

