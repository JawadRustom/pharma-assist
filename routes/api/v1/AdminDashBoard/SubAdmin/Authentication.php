<?php

use App\Http\Controllers\Api\V1\Application\Auth\AuthenticationController as UserAuthenticationController;
use App\Http\Controllers\Api\V1\AdminDashboard\Auth\SubAdmin\AuthenticationController as SubAdminAuthAuthenticationController;
use App\Http\Middleware\Api\V1\Application\Auth\GuestMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('/logout', [UserAuthenticationController::class, 'logout']);

Route::middleware(GuestMiddleware::class)->group(function(){
    Route::post('/login/subAdmin', [SubAdminAuthAuthenticationController::class, 'subAdmin']);
});
