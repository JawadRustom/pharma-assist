<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\HomePage\CategoryResource;
use App\Http\Resources\Api\V1\Application\HomePage\CompanyResource;
use App\Http\Resources\Api\V1\Application\HomePage\MedicineResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\Medicine;
use Illuminate\Support\Facades\Cache;

class HomePageController extends Controller
{
    public function __invoke()
    {
        $dataMedicine =
        Cache::remember('last-medicines', 600, fn() => Medicine::orderBy('id', 'desc')->limit(3)->get());
        $datacompanies =
        Cache::remember('last-companies', 600, fn() => Company::orderBy('id', 'desc')->limit(6)->get());
        $dataCategories =
        Cache::remember('last-Categories', 600, fn() => Category::orderBy('id', 'desc')->limit(6)->get());
        return response()->json([
            'medicine' => MedicineResource::collection($dataMedicine),
            'company' => CompanyResource::collection($datacompanies),
            'category' => CategoryResource::collection($dataCategories),
        ]);
    }
}
