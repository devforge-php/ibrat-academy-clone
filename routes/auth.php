<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Auth\AuthController;

Route::post('/send-code', [AuthController::class, 'sendVerificationCode'])->middleware('throttle:5,1'); // 1 daqiqada 5 marta urinish
Route::post('/verify-code', [AuthController::class, 'verifyCode']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');