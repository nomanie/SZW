<?php

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

