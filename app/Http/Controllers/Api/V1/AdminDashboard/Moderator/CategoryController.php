<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\CategoryRequest\StoreCategoryRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\CategoryRequest\UpdateCategoryRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Moderator\CategoryResource\CategoryResource;
use Illuminate\Http\Request;

/**
 * @group Category
 *
 * This Api For Category for Moderator in AdminDashboard
 */
class CategoryController extends Controller
{
    /**
     * See all Category
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 16,
            "name": "dsa1234sad",
            "Image": {
                "id": 1,
                "imageable_id": 16,
                "imageable_type": "App\\Models\\Category",
                "file_name": "http://127.0.0.1:8000/storage/Category/mg89X1m2KAZcOFE299I5P2Wb16b452WCYSxwhGY2.png"
            }
        },
        {
            "id": 15,
            "name": "Mr. Erin Bashirian PhD",
            "Image": null
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/categories?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/categories?page=8",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/moderator/categories?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 8,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/categories",
        "per_page": 2,
        "to": 2,
        "total": 16
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
     * See categories belong to moderator
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 16,
            "name": "dsa1234sad",
            "Image": {
                "id": 1,
                "imageable_id": 16,
                "imageable_type": "App\\Models\\Category",
                "file_name": "http://127.0.0.1:8000/storage/Category/mg89X1m2KAZcOFE299I5P2Wb16b452WCYSxwhGY2.png"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/categories/categoriesOfModerator?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/categories/categoriesOfModerator?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/categories/categoriesOfModerator?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/categories/categoriesOfModerator",
        "per_page": 2,
        "to": 1,
        "total": 1
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This Company not found"{
       "message": "not found"
       }
     *
     */
    public function categoriesOfModerator(Request $request)
    {
        $user = auth()->user();
        $data = Category::whereHas('users', fn ($query) => $query->where('user_id', $user->id))->orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CategoryResource::collection($data);
    }
    /**
     * See One Category
     * @response 200 scenario="Success Process"{
     * }
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
        "id": 16,
        "name": "dsa1234sad",
        "Image": {
            "id": 1,
            "imageable_id": 16,
            "imageable_type": "App\\Models\\Category",
            "file_name": "http://127.0.0.1:8000/storage/Category/mg89X1m2KAZcOFE299I5P2Wb16b452WCYSxwhGY2.png"
        }
    }
}
     *
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
            "The name has already been taken."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     * @queryparam file_name image
     * To upload image.
     *
     */
    public function store(StoreCategoryRequest $request)
    {
        $user = auth()->user();
        $data = Category::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);
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
        "id": 16,
        "name": "dsa1234sad",
        "Image": {
            "id": 1,
            "imageable_id": 16,
            "imageable_type": "App\\Models\\Category",
            "file_name": "http://127.0.0.1:8000/storage/Category/mg89X1m2KAZcOFE299I5P2Wb16b452WCYSxwhGY2.png"
        }
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
            "The name has already been taken."
        ]
    }
}
     *
     * @response 404 scenario="This Category not found"{
       "message": "not found"
       }
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     * @queryparam file_name image
     * To upload image.
     *
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $user = auth()->user();
        if ($user->id == $category->user_id) {
            $category->update([
                'name' => $request->name,
                'user_id' => $user->id
            ]);
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
        return response("This category not belong to you", 404);
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
        $user = auth()->user();
        if ($user->id == $category->user_id) {
            $category->delete();
            return response()->noContent();
        }
        return response("This category not belong to you", 404);
    }
}
