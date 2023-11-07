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
use Illuminate\Support\Facades\Cache;

class HomePageController extends Controller
{
    public function seeLastMedicines()
    {
        $data =
            Cache::remember('last-medicines', 600, fn () => Medicine::orderBy('id', 'desc')->limit(3)->get());
        return MedicineResource::collection($data);
    }
    public function seeLastCompanies()
    {
        $data =
            Cache::remember('last-medicines', 600, fn () => Company::orderBy('id', 'desc')->limit(6)->get());
        return CompanyResource::collection($data);
    }
    public function seeLastCategories()
    {
        $data =
            Cache::remember('last-medicines', 600, fn () => Category::orderBy('id', 'desc')->limit(6)->get());
        return CategoryResource::collection($data);
    }
}
