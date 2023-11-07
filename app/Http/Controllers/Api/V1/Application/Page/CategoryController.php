<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Application\Page\CategoryRequest;
use App\Models\Category;
use App\Http\Resources\Api\V1\Application\HomePage\CategoryResource;

class CategoryController extends Controller
{   
    public function index(CategoryRequest $request)
    {
        $data = Category::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        
        return CategoryResource::collection($data);
    }

    public function medicines(Category $category, CategoryRequest $request)
    {
        $data = Category::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        
        return CategoryResource::collection($data);
    }
}
