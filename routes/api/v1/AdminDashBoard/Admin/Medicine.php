<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\MedicineController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->group(function () {
    Route::apiResource('/medicines', MedicineController::class)->except(['update']);
    Route::post('/medicines/{medicine}', [MedicineController::class, 'update']);
});
