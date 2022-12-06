<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['as' => 'api.'], function() {
    Route::get('/enums/{enum}/{function?}', [App\Http\Controllers\api\v1\Enums\EnumsController::class, 'getOptions'])->name('get.options');

    Route::prefix('workshop')->name('workshop.')->group(function() {
       Route::apiResource('workers', App\Http\Controllers\api\v1\Workshop\Workers\WorkerController::class);
       Route::apiResource('workshop', \App\Http\Controllers\api\v1\Workshop\WorkshopInformations\WorkshopController::class);
   });
});

include_once('adminApi.php');
