<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\CategoryController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->apiResource('/categories', CategoryController::class);
