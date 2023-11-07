<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\MedicineDetailController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->apiResource('/admin/medicineDetails', MedicineDetailController::class);
