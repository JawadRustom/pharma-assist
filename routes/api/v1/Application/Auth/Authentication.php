<?php

use App\Http\Controllers\Api\V1\Application\Auth\AuthenticationController;
use App\Http\Middleware\Api\V1\Application\Auth\GuestMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('/logout', [AuthenticationController::class, 'logout']);

Route::middleware(GuestMiddleware::class)->group(function(){
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/register', [AuthenticationController::class, 'register']);
});
