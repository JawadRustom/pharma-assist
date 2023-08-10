<?php

use App\Http\Controllers\Api\V1\Application\Auth\AuthenticationController as UserAuthenticationController;
use App\Http\Controllers\Api\V1\AdminDashboard\Auth\Admin\AuthenticationController as AdminAuthenticationController;
use App\Http\Middleware\Api\V1\Application\Auth\GuestMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('/logout', [UserAuthenticationController::class, 'logout']);

Route::middleware('check_user_login')->group(function(){
    Route::post('/login/admin', [AdminAuthenticationController::class, 'loginAdmin']);
});
