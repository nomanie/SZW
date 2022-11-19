<?php

use Illuminate\Http\Request;
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
    Route::apiResource('workers', App\Http\Controllers\api\v1\Workshop\Workers\WorkerController::class);
    Route::apiResource('workshop', App\Http\Controllers\api\v1\Workshop\WorkshopController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
