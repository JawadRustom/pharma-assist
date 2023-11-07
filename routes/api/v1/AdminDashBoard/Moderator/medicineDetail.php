<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\MedicineDetailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::get('/moderator/medicineDetails/medicineDetailsOfModerator', [MedicineDetailController::class, 'medicineDetailsOfModerator']);
});
Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::apiResource('/moderator/medicineDetails', MedicineDetailController::class)->except(['update']);
    Route::post('/moderator/medicineDetails/{medicineDetail}', [MedicineDetailController::class, 'update']);
});
