<?php

use App\Http\Controllers\Api\V1\Application\Page\CompanyPageController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:user'])->group(function () {
    Route::get('/companyPage/companies', [CompanyPageController::class, 'seeCompanies']);
});
