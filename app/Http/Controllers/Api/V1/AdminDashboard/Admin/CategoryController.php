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
            "id": 17,
            "name": "test",
            "Image": {
                "id": 1,
                "imageable_id": 17,
                "imageable_type": "App\\Models\\Category",
                "file_name": "http://127.0.0.1:8000/storage/Category/7BOV5PVPvB7c4hA3pVFX8GO3AbE75wW6Gec66jiP.png"
            },
            "user": {
                "id": 11,
                "full_name": [
                    "Admin",
                    "Admin"
                ]
            }
        },
        {
            "id": 16,
            "name": "testdaads",
            "Image": null,
            "user": {
                "id": 11,
                "full_name": [
                    "Admin",
                    "Admin"
                ]
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/admin/categories?page=1",
        "last": "http://127.0.0.1:8000/api/v1/admin/categories?page=9",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/admin/categories?page=2"
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
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/categories?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/admin/categories",
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
        "id": 17,
        "name": "test",
        "Image": {
            "id": 1,
            "imageable_id": 17,
            "imageable_type": "App\\Models\\Category",
            "file_name": "http://127.0.0.1:8000/storage/Category/7BOV5PVPvB7c4hA3pVFX8GO3AbE75wW6Gec66jiP.png"
        },
        "user": {
            "id": 11,
            "full_name": [
                "Admin",
                "Admin"
            ]
        }
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
        "id": 17,
        "name": "test",
        "Image": {
            "id": 1,
            "imageable_id": 17,
            "imageable_type": "App\\Models\\Category",
            "file_name": "http://127.0.0.1:8000/storage/Category/7BOV5PVPvB7c4hA3pVFX8GO3AbE75wW6Gec66jiP.png"
        },
        "user": {
            "id": 11,
            "full_name": [
                "Admin",
                "Admin"
            ]
        }
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
     */
    public function store(StoreCategoryRequest $request)
    {
        // $data = User::create([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'password' => $request->password,
        //     'phone_number' => $request->phone_number,
        //     'role_id' => 2,
        // ]);
        // return new ModeratorResource($data);
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
        "id": 12,
        "name": "asd",
        "Image": {
            "id": 2,
            "imageable_id": 12,
            "imageable_type": "App\\Models\\Category",
            "file_name": "http://127.0.0.1:8000/storage/Category/xyFaV1KL3o6Hhj8OKm8hLES1Etvu9q2L5Ey122eD.png"
        },
        "user": null
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
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'user_id' => $category->user_id
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
