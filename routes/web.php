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
    $data = [
        "id" => 1,
        "client_id" => 1,
        "car_id" => null,
        "fv_number" => "1/2023/12",
        "issuer_name" => "Piotr Skwarek",
        "issuer_address" => 'osiedle 1000-lecia 6/1 44-268 Jastrzębie-Zdrój',
        "issuer_nip" => "123",
        "recipient_name" => "Adam Nowak",
        "recipient_address" => "kalinowa 52/5 44-220 Sosnowiec",
        "recipient_nip" => "213",
        "fv_header" => "Header",
        "fv_footer" => null,
        "issue_at" => null,
        "sale_at" => null,
        "payment_type" => 0,
        "payment_date" => "2023-02-10",
        "account_number" => "12-3",
        "bank_type" => 1,
        "comments" => "0",
        "issue_date" => "2023-10-10",
        "sold_date" => "2023-10-21",
        "sum_net" => 201.15,
        "sum_vat" => 40.51,
        "sum_gross" => 241.66,
        "deleted_at" => null,
        "created_at" => "2023-02-06T21:20:21.000000Z",
        "updated_at" => "2023-02-06T21:20:21.000000Z",
        "document_contents" => [
            [
                "id" => 1,
                "document_id" => 1,
                "name" => "test",
                "units" => 5,
                "unit_net" => 35.23,
                "vat_rate_id" => 0,
                "sum_net" => 176.15,
                "sum_vat" => 40.51,
                "sum_gross" => 216.66,
                "deleted_at" => null,
                "created_at" => "2023-02-06T21:20:21.000000Z",
                "updated_at" => "2023-02-06T21:20:21.000000Z",
            ],
            [
                "id" => 2,
                "document_id" => 1,
                "name" => "test2",
                "units" => 2,
                "unit_net" => 12.5,
                "vat_rate_id" => 0,
                "sum_net" => 25.0,
                "sum_vat" => 0.0,
                "sum_gross" => 25.0,
                "deleted_at" => null,
                "created_at" => "2023-02-06T21:20:21.000000Z",
                "updated_at" => "2023-02-06T21:20:21.000000Z",
            ]
        ]
    ];
    return view('global.documents.invoice')->with(['data' => $data]);
});


