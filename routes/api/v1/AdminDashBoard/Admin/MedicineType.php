<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\MedicineTypeController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->apiResource('/medicineTypes', MedicineTypeController::class);
