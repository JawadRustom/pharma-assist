<?php

use App\Helpers\Route\RouteHelper;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->middleware('language')->group(function () {
    RouteHelper::includeRouteFiles(__DIR__ . '/api/v1');
});

