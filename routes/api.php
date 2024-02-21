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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('json1', function () {
    $file = public_path('json/json1.json');
    $data = file_get_contents($file);
    return json_decode($data);
});

Route::get('json2', function () {
    $file = public_path('json/json2.json');
    $data = file_get_contents($file);
    return json_decode($data);
});

