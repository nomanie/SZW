<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('workshop.pages.dashboard');
})->name('dashboard');
Route::get('/clients', function () {
    return view('workshop.pages.clients');
})->name('clients');
Route::get('/documents', function () {
    return view('workshop.pages.documents');
})->name('documents');
Route::get('/messages', function () {
    return view('workshop.pages.messages');
})->name('messages');
Route::get('/repairs', function () {
    return view('workshop.pages.repairs');
})->name('repairs');
Route::get('/support', function () {
    return view('workshop.pages.support');
})->name('support');
Route::get('/calendar', function () {
    return view('workshop.pages.calendar');
})->name('calendar');
Route::get('/informations', function () {
    return view('workshop.pages.informations');
})->name('informations');
Route::get('/settings', function () {
    return view('workshop.pages.settings');
})->name('settings');
Route::get('/users', function () {
    return view('workshop.pages.users');
})->name('users');
Route::get('/error-report', function () {
    return view('workshop.pages.errorReport');
})->name('error-report');
