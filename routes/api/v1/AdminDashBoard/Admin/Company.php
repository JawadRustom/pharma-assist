<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'userType:admin'])->group(function () {
    Route::apiResource('/admin/companies', CompanyController::class)->except(['update']);
    Route::post('/admin/companies/{company}', [CompanyController::class, 'update']);
});
