<?php

use App\Http\Controllers\Api\V1\Application\Page\CategoryController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:user'])->group(function () {
    Route::get('/category', [CategoryController::class, 'index']);

    Route::get('/category/{category}/medicine', [CategoryController::class, 'medicine']);
});
