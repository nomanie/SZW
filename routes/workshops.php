<?php

declare(strict_types=1);

use App\Http\Controllers\api\v1\Workshop\WorkshopInformations\WorkshopController;
use App\Http\Middleware\InitializeTenancyByPath;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the workshops routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group([
    'prefix' => '/{tenant:uuid}',
    'as' => 'workshop.',
    'middleware' => [\App\Http\Middleware\WorkshopMiddleware::class, InitializeTenancyByPath::class, \App\Http\Middleware\CheckRouteDataMiddleware::class],
], function () {
    //@todo przenieść widoki do controllera
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
    Route::get('/workers', function () {
        return view('workshop.pages.errorReport');
    })->name('error-report');

    Route::resource('informations', WorkshopController::class)->only('index', 'update');
});
