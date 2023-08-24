<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\MedicineOfCompanyForModeratorController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::get('/moderator/medicinesOfCompanyForModerator/{name}', [MedicineOfCompanyForModeratorController::class,'seeMedicineOfCompanyForModerator']);
});
