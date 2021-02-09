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
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('admin',AdminController::class);
    Route::apiResource('admin-driver',DriverController::class);
    Route::apiResource('admin-client',ClientController::class);
    Route::apiResource('admin-bus',BusController::class);
    Route::apiResource('client-booking',BookingController::class);
});

//client config
Route::post('client/login',[App\Http\Controllers\ClientController::class,'login']);
Route::post('client/register',[App\Http\Controllers\ClientController::class,'register']);
Route::get('client/buses',[App\Http\Controllers\BusController::class,'viewClient']);
Route::get('client/history/{id}',[App\Http\Controllers\HistoryController::class, 'history']);
//admin log-reg
Route::post('admin/login',[App\Http\Controllers\AdminController::class,'login']);
Route::post('admin/register',[App\Http\Controllers\AdminController::class,'register']);
//Booking
Route::post('client/booking/send/{client}',[App\Http\Controllers\BookingController::class,'store']);




