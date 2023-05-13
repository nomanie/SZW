<?php

declare(strict_types=1);

use App\Http\Controllers\api\v1\Workshop\Cars\ArchivedCarController;
use App\Http\Controllers\api\v1\Workshop\Cars\CarController;
use App\Http\Controllers\api\v1\Workshop\Clients\ArchivedClientController;
use App\Http\Controllers\api\v1\Workshop\Clients\ClientController;
use App\Http\Controllers\api\v1\Workshop\Documents\DocumentController;
use App\Http\Controllers\api\v1\Workshop\Workers\WorkerController;
use App\Http\Controllers\api\v1\Workshop\WorkshopInformations\WorkshopController;
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
Route::as('workshop.')->group(function () {
    Route::group([
        'prefix' => '/api/{tenant:uuid}',
        'middleware' => [\App\Http\Middleware\WorkshopMiddleware::class, App\Http\Middleware\InitializeTenancyByPath::class],
    ], function () {
        Route::post('/workshops/{workshop}/upload/logo', [WorkshopController::class, 'upload'])->name('upload.logo');
        Route::resource('/workshops', WorkshopController::class)->only(['index', 'update']);

        Route::as('workers.')->prefix('/workers')->group(function () {
            Route::post('/export', [WorkerController::class, 'export'])->name('export');
            Route::get('/download/{mediable}', [WorkerController::class, 'download'])->name('download');
            Route::resource('contracts', App\Http\Controllers\api\v1\Workshop\Workers\ContractController::class);
            Route::resource('permissions', App\Http\Controllers\api\v1\Workshop\Workers\Permission\PermissionController::class);
        });
        Route::resource('/workers', App\Http\Controllers\api\v1\Workshop\Workers\WorkerController::class);

        Route::as('clients.')->prefix('/clients')->group(function () {
            Route::post('/export', [ClientController::class, 'export'])->name('export');
            Route::get('/download/{mediable}', [ClientController::class, 'download'])->name('download');
        });
        Route::resource('/clients', ClientController::class);

        Route::as('archived_clients.')->prefix('/archived_clients')->group(function () {
            Route::post('/export', [ArchivedClientController::class, 'export'])->name('export');
            Route::get('/download/{mediable}', [ArchivedClientController::class, 'download'])->name('download');
        });
        Route::resource('/archived_clients', ArchivedClientController::class);

        Route::as('cars.')->prefix('/cars')->group(function () {
            Route::post('/export', [CarController::class, 'export'])->name('export');
            Route::get('/download/{mediable}', [CarController::class, 'download'])->name('download');
        });
        Route::resource('/cars', CarController::class);

        Route::as('archived_cars.')->prefix('/archived_cars')->group(function () {
            Route::post('/export', [ArchivedCarController::class, 'export'])->name('export');
            Route::get('/download/{mediable}', [ArchivedCarController::class, 'download'])->name('download');
        });
        Route::resource('/archived_cars', ArchivedCarController::class);

        Route::as('documents.')->prefix('/documents')->group(function () {
            Route::post('/export', [DocumentController::class, 'export'])->name('export');
            Route::get('/download/token', [DocumentController::class, 'getDownloadToken'])->name('token');
            Route::get('/download/{mediable}', [DocumentController::class, 'download'])->name('download');
            Route::get('/download_document/{document}', [DocumentController::class, 'downloadDocument'])->name('download_document');
        });
        Route::resource('/documents', DocumentController::class);
    });
});
