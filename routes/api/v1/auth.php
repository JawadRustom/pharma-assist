<?php

use App\Http\Controllers\Api\V1\Auth\RegisterationController;
use App\Services\Auth\RegisterationService;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {

    Route::post('auth/{provider}', [RegisterationController::class, 'login'])->whereIn('provider', array_keys(RegisterationService::PROVIDERS));
    Route::post('auth/register/{provider}', [RegisterationController::class, 'register'])->whereIn('provider', array_keys(RegisterationService::PROVIDERS));
    Route::middleware('auth:sanctum')->post('auth/logout', [RegisterationController::class, 'logout']);
});
