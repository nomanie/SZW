<?php

declare(strict_types=1);

use App\Http\Controllers\api\v1\Workshop\Cars\ArchivedCarController;
use App\Http\Controllers\api\v1\Workshop\Cars\CarController;
use App\Http\Controllers\api\v1\Workshop\Clients\ArchivedClientController;
use App\Http\Controllers\api\v1\Workshop\Clients\ClientController;
use App\Http\Controllers\api\v1\Workshop\Documents\DocumentController;
use App\Http\Controllers\api\v1\Workshop\Workers\WorkerController;
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
Route::as('workshop.')->group(function(){
    Route::group([
        'prefix' => '/{tenant:uuid}',
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
            return view('workshop.pages.workers.workers.index');
        })->name('workers.index');
        Route::get('/workers/{worker}', function () {
            return view('workshop.pages.workers.workers.show');
        })->name('workers.details');
        Route::get('/clients/{client}', function () {
            return view('workshop.pages.clients.show');
        })->name('clients.details');

    });
    Route::post('/workshops/{workshop}/upload/logo', [WorkshopController::class, 'upload'])->name('upload.logo');
    Route::resource('/workshops', WorkshopController::class)->only(['index', 'update']);

    Route::as('workers.')->prefix('/workers')->group(function(){
        Route::post('/export', [WorkerController::class, 'export'])->name('workers.export');
        Route::get('/download/{mediable}', [WorkerController::class, 'download'])->name('workers.download');
        Route::resource('contracts', App\Http\Controllers\api\v1\Workshop\Workers\ContractController::class);
        Route::resource('permissions', App\Http\Controllers\api\v1\Workshop\Workers\Permission\PermissionController::class);
    });
    Route::resource('/workers', App\Http\Controllers\api\v1\Workshop\Workers\WorkerController::class);

    Route::as('clients.')->prefix('/clients')->group(function(){
        Route::post('/export', [ClientController::class, 'export'])->name('clients.export');
        Route::get('/download/{mediable}', [ClientController::class, 'download'])->name('clients.download');
    });
    Route::resource('/clients', ClientController::class);

    Route::as('archived_clients.')->prefix('/archived_clients')->group(function(){
        Route::post('/export', [ArchivedClientController::class, 'export'])->name('archived_clients.export');
        Route::get('/download/{mediable}', [ArchivedClientController::class, 'download'])->name('archived_clients.download');
    });
    Route::resource('/archived_clients', ArchivedClientController::class);

    Route::as('cars.')->prefix('/cars')->group(function(){
        Route::post('/export', [CarController::class, 'export'])->name('cars.export');
        Route::get('/download/{mediable}', [CarController::class, 'download'])->name('cars.download');
    });
    Route::resource('/cars', CarController::class);

    Route::as('archived_cars.')->prefix('/archived_cars')->group(function(){
        Route::post('/export', [ArchivedCarController::class, 'export'])->name('archived_cars.export');
        Route::get('/download/{mediable}', [ArchivedCarController::class, 'download'])->name('archived_cars.download');
    });
    Route::resource('/archived_cars', ArchivedCarController::class);

    Route::as('documents.')->prefix('/documents')->group(function(){
        Route::post('/export', [DocumentController::class, 'export'])->name('documents.export');
        Route::get('/download/{mediable}', [DocumentController::class, 'download'])->name('documents.download');
        Route::get('/download_document/{document}', [DocumentController::class, 'downloadDocument'])->name('download_document');
    });
    Route::resource('/documents', DocumentController::class);
});
