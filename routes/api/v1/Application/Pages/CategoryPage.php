<?php

use App\Http\Controllers\Api\V1\Application\Page\CategoryPageController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:user'])->group(function () {
    Route::get('/categoryPage/categories', [CategoryPageController::class, 'seeCategories']);
});
