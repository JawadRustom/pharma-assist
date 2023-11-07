<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::get('/moderator/companies/companiesOfModerator', [CompanyController::class, 'companiesOfModerator']);
});
Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::apiResource('/moderator/companies', CompanyController::class)->except(['update']);
    Route::post('/moderator/companies/{company}', [CompanyController::class, 'update']);
});
