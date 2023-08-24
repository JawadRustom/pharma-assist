<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\MedicineController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::get('/moderator/medicines/medicinesOfModerator', [MedicineController::class, 'medicinesOfModerator']);
});
Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::apiResource('/moderator/medicines', MedicineController::class)->except(['update']);
    Route::post('/moderator/medicines/{medicine}', [MedicineController::class, 'update']);
});
