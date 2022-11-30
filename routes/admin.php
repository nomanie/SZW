<?php

use App\Http\Controllers\Admin\Cars\CarBrandsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.pages.dashboard');
    })->name('dashboard');
    Route::prefix('/cars')->name('cars.')->group(function () {
        Route::get('/brands', function () {
            return view('admin.pages.cars.brand');
        })->name('brands.list');
        Route::get('/models', function () {
            return view('admin.pages.cars.model');
        })->name('models.list');
        Route::get('/series', function () {
            return view('admin.pages.cars.seria');
        })->name('series.list');
        Route::get('/generations', function () {
            return view('admin.pages.cars.generation');
        })->name('generations.list');
        Route::get('/engines', function () {
            return view('admin.pages.cars.engine');
        })->name('engines.list');
        Route::get('/types', function () {
            return view('admin.pages.cars.type');
        })->name('types.list');
    });
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::prefix('/cars')->name('cars.')->group(function () {
        Route::post('/brands/export', [CarBrandsController::class, 'export'])->name('brand.export');
        Route::get('/brands/download', [CarBrandsController::class, 'download'])->name('brand.download');
        Route::resource('/brands', CarBrandsController::class);
    });
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::prefix('/datatables')->name('datatables.')->group(function () {
        Route::post('/reorder/{id}', [\App\Http\Controllers\Admin\Datatables\DatatableStateController::class, 'reorder'])->name('reorder');
    });
});

