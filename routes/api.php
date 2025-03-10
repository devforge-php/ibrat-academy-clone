<?php

use App\Http\Controllers\Profile\UserAdressController;
use App\Http\Controllers\Profile\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Profile start
Route::middleware(['auth:sanctum'])->group( function () {
    Route::get('profile', [UserProfileController::class, 'show']);
   Route::post('profile', [UserProfileController::class, 'update']);
   Route::get('adress', [UserAdressController::class, 'show']);
  Route::post('adress', [UserAdressController::class, 'update']);
        });