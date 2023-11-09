<?php

use App\Http\Controllers\Api\V1\Application\Page\CompanyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:user'])->group(function () {
    Route::get('/company', [CompanyController::class, 'index']);
    Route::get('/company/{company}/medicine', [CompanyController::class, 'medicines']);
});
