<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineResource\MedicineResource;

class MedicineController extends Controller
{
    public function __invoke(Medicine $medicine)
    {
        return new MedicineResource($medicine);
    }
}
