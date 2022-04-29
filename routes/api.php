<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SmsController;
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

Route::apiResource('phones', PhoneController::class)->except(['show']);
Route::apiResource('emails', EmailController::class)->except(['show']);
Route::apiResource('sms', SmsController::class)->except(['show']);

Route::apiResource('messages', MessageController::class)->only(['index']);
