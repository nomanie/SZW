<?php

use App\Http\Controllers\Admin\Cars\CarBrandsController;
use App\Http\Controllers\Admin\Cars\CarEnginesController;
use App\Http\Controllers\Admin\Cars\CarGenerationsController;
use App\Http\Controllers\Admin\Cars\CarModelsController;
use App\Http\Controllers\Admin\Cars\CarSeriesController;
use App\Http\Controllers\Admin\Cars\CarTypesController;
use Illuminate\Support\Facades\Route;
// @todo dodać admin middleware
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::prefix('/cars')->name('cars.')->group(function () {
        Route::resource('/brand', CarBrandsController::class);
        Route::resource('/model', CarModelsController::class);
        Route::resource('/engine', CarEnginesController::class);
        Route::resource('/generation', CarGenerationsController::class);
        Route::resource('/seria', CarSeriesController::class);
        Route::resource('/type', CarTypesController::class);
    });
});
