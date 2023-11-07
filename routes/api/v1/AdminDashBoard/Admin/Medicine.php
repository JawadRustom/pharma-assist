<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\MedicineController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->group(function () {
    Route::apiResource('/admin/medicines', MedicineController::class)->except(['update']);
    Route::post('/admin/medicines/{medicine}', [MedicineController::class, 'update']);
    // Route::post('/admin/medicines', [MedicineController::class, 'store']);
});
