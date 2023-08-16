<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\HomePage\CategoryResource;
use App\Http\Resources\Api\V1\Application\HomePage\CompanyResource;
use App\Http\Resources\Api\V1\Application\HomePage\MedicineResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\Medicine;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function seeLastMedicines(Request $request)
    {
        $data = Medicine::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineResource::collection($data);
    }
    public function seeLastCompanies(Request $request)
    {
        $data = Company::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CompanyResource::collection($data);
    }
    public function seeLastCategories(Request $request)
    {
        $data = Category::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CategoryResource::collection($data);
    }

}
