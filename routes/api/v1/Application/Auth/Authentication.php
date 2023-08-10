<?php

use App\Http\Controllers\Api\V1\Application\Auth\AuthenticationController as UserAuthenticationController;
use App\Http\Middleware\Api\V1\Application\Auth\GuestMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('/logout', [UserAuthenticationController::class, 'logout']);

Route::middleware('check_user_login')->group(function(){
    Route::post('/login', [UserAuthenticationController::class, 'login']);
    Route::post('/register', [UserAuthenticationController::class, 'register']);
});
