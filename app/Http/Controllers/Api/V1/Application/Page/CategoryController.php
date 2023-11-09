<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Application\Page\CategoryRequest;
use App\Http\Resources\Api\V1\Application\HomePage\CategoryResource;
use App\Http\Resources\Api\V1\Application\HomePage\MedicineResource;
use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(/*CategoryRequest $request*/ Request $request)
    {
        $data = Category::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CategoryResource::collection($data);
    }

    public function medicines(Category $category, /*CategoryRequest $request*/ Request $request)
    {
        $data = Medicine::where('category_id',$category->id)->orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineResource::collection($data);
    }
}
