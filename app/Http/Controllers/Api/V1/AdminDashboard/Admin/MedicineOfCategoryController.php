<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\DataPage\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineOfCategoryController extends Controller
{
    public function seeMedicineOfCategory(Request $request, $name)
    {
            $data = Medicine::orderBy('id', 'desc')->whereHas('categories', fn ($query) => $query->where('name', $name))->paginate($request->perPage ?? 15);
            return MedicineResource::collection($data);
    }
}
