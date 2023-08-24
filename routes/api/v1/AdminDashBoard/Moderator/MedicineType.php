<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\MedicineDetailController;
use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\MedicineTypeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::get('/moderator/medicineTypes/medicineTypesOfModerator', [MedicineTypeController::class, 'medicineTypesOfModerator']);
});
Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::apiResource('/moderator/medicineTypes', MedicineTypeController::class)->except(['update']);
    Route::post('/moderator/medicineTypes/{medicineType}', [MedicineTypeController::class, 'update']);
});
