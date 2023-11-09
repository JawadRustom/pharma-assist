<?php

use App\Http\Controllers\Api\V1\Application\Page\MedicineController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:user'])->group(function () {
    Route::get('/medicine/{medicine}', MedicineController::class);
});
