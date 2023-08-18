<?php

use App\Http\Controllers\Api\V1\Application\Page\DataPageController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:user'])->group(function () {
    Route::get('/dataPage/medicineData/{dataFrom}/{name}', [DataPageController::class, 'seeDataForMedicine']);
});
