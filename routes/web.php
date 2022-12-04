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

include_once('admin.php');
include_once('wiki.php');
include_once('auth.php');
include_once('client.php');
include_once('workshops.php');

Route::get('/', function () {
    return view('welcome');
});


