<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\CategoryRequest\StoreCategoryRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\CategoryRequest\UpdateCategoryRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\CategoryResource\CategoryResource;
use Illuminate\Http\Request;

/**
 * @group Admin Category
 *
 * This Api For Admin Category
 */
class CategoryController extends Controller
{
    /**
     * See all Category
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 1,
            "name": "Ms. Lilyan Langosh DDS",
        },
        {
            "id": 2,
            "name": "Lyla Johnson MD",
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/category?page=1",
        "last": "http://127.0.0.1:8000/api/v1/category?page=9",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/category?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 9,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/category?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/category",
        "per_page": 2,
        "to": 2,
        "total": 17
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     * * @queryparam perPage int
     * To return limite data in single page.
     * Defaults value for variable '15'.
     *
     */
    public function index(Request $request)
    {
        $data = Category::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CategoryResource::collection($data);
    }

    /**
     * See One Category
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 2,
        "name": "Lyla Johnson MD",
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This Category not found"{
       "message": "not found"
       }
     *
     */
    public function show(Request $request, Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Create Category
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 19,
        "name": "test",
    }
}
     *
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = Category::create($request->validated());
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('public/Category');
            $data->photos()->create(['file_name' => $photoPath]);
        }
        return new CategoryResource($data);
    }

    /**
     * Update Category
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 3,
        "name": "testtest",
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
        ]
    }
}
     * @response 404 scenario="This Category not found"{
       "message": "not found"
       }
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('public/Category');
            $category->photos()->updateOrCreate(
                [],
                ['file_name' => $photoPath]
            );
        }
        $category->refresh();
        return new CategoryResource($category);
    }
    /**
     * Delete Category
     * @response 204 scenario="Success Process"
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This Category not found"{
       "message": "not found"
       }
     *
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
