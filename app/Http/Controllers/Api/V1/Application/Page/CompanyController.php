<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\HomePage\CompanyResource;
use App\Http\Resources\Api\V1\Application\HomePage\MedicineResource;
use App\Models\Company;
use App\Models\Medicine;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(/*CategoryRequest $request*/ Request $request)
        {
            $data = Company::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
            return CompanyResource::collection($data);
        }

        public function medicines(Company $company, /*CategoryRequest $request*/ Request $request)
        {
            $data = Medicine::where('company_id',$company->id)->orderBy('id', 'desc')->paginate($request->perPage ?? 15);
            return MedicineResource::collection($data);
        }
}
