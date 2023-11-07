<?php

use App\Http\Controllers\Api\V1\Application\Auth\AuthenticationController as UserAuthenticationController;
use App\Http\Controllers\Api\V1\AdminDashboard\Auth\Moderator\AuthenticationController as ModeratorAuthAuthenticationController;
use App\Http\Middleware\Api\V1\Application\Auth\GuestMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('/logout', [UserAuthenticationController::class, 'logout']);

Route::middleware('checkUserLogin')->group(function(){
    Route::post('/moderator/login', [ModeratorAuthAuthenticationController::class, 'loginModerator']);
});
