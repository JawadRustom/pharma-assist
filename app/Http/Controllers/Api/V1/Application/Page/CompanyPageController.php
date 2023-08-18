<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\HomePage\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyPageController extends Controller
{
    public function seeCompanies(Request $request)
    {
        $data = Company::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CompanyResource::collection($data);
    }
}
