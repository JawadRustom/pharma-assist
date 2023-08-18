<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\HomePage\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    public function seeCategories(Request $request)
    {
        $data = Category::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CategoryResource::collection($data);
    }
}
