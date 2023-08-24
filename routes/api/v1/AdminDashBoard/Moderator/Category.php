<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::get('/moderator/categories/categoriesOfModerator', [CategoryController::class, 'categoriesOfModerator']);
});
Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::apiResource('/moderator/categories', CategoryController::class)->except(['update']);
    Route::post('/moderator/categories/{category}', [CategoryController::class, 'update']);
});
