<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\DataPage\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DataPageController extends Controller
{
    public function seeDataForMedicine(Request $request, Medicine $medicine)
    {
        return response(['message' => 'Invalid data value'], 400);
    }
}
