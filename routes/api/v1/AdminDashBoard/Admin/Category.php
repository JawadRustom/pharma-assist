<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'userType:admin'])->group(function () {
    Route::apiResource('/categories', CategoryController::class)->except(['update']);
    Route::post('/categories/{category}', [CategoryController::class, 'update']);
});


//api/v1/categories/{category}
