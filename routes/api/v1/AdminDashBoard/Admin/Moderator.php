<?php

use App\Http\Controllers\Api\V1\AdminDashboard\Admin\ModeratorController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'userType:admin'])->apiResource('/admin/moderator', ModeratorController::class);
