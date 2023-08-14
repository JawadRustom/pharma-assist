<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\CompanyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->apiResource('/companies', CompanyController::class);
