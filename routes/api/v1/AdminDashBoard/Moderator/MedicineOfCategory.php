<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Moderator\MedicineOfCategoryForModeratorController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:moderator'])->group(function () {
    Route::get('/moderator/medicinesOfCategoryForModeratorController/{name}', [MedicineOfCategoryForModeratorController::class,'seeMedicineOfCategoryForModerator']);
});
