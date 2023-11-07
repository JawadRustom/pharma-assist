<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\MedicineOfCategoryController;
use App\Http\Controllers\Api\V1\AdminDashboard\Admin\MedicineOfCopmanyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->group(function () {
    Route::get('/admin/medicinesOfCategory/{name}', [MedicineOfCategoryController::class,'seeMedicineOfCategory']);
});
