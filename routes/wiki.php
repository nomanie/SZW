<?php

use Illuminate\Support\Facades\Route;

Route::domain('wiki.' . env('APP_URL'))->name('wiki.')->group(function() {
    Route::get('/', function () {
        return view('wiki.pages.start');
    })->name('start');
});

