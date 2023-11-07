<?php

use App\Http\Controllers\Api\V1\Application\Page\HomePageController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:user'])->group(function () {
    Route::get('/homePage/medicines', [HomePageController::class, 'seeLastMedicines']);
    Route::get('/homePage/companies', [HomePageController::class, 'seeLastCompanies']);
    Route::get('/homePage/categories', [HomePageController::class, 'seeLastCategories']);
});
