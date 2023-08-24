<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\ModeratorRequest\StoreModeratorRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\ModeratorRequest\UpdateModeratorRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\ModeratorResource\ModeratorResource;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group Admin Moderator
 *
 * This Api For Moderator
 */
class ModeratorController extends Controller
{
    /**
     * See all Moderator
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 12,
            "first_name": "Moderator",
            "last_name": "Moderator",
            "email": "Moderator@Moderator.com",
            "role": {
                "id": 2,
                "name": "moderator"
            },
            "password": "$2y$10$k9sqwjx95UEdMhnVZMnQu.Dua.dwREtBOxBgOQ8T3pR7K9xfCcOeS",
            "phone_number": 987372763
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/admin/moderators?page=1",
        "last": "http://127.0.0.1:8000/api/v1/admin/moderators?page=1",
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
                "url": "http://127.0.0.1:8000/api/v1/admin/moderators?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/admin/moderators",
        "per_page": 15,
        "to": 1,
        "total": 1
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
        $data = User::orderBy('id', 'desc')->whereHas('roles', fn ($query) => $query->where('name', 'moderator'))->paginate($request->perPage ?? 15);
        return ModeratorResource::collection($data);
    }
    /**
     * See One Moderator
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 12,
        "first_name": "Moderator",
        "last_name": "Moderator",
        "email": "Moderator@Moderator.com",
        "role": {
            "id": 2,
            "name": "moderator"
        },
        "password": "$2y$10$k9sqwjx95UEdMhnVZMnQu.Dua.dwREtBOxBgOQ8T3pR7K9xfCcOeS",
        "phone_number": 987372763
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This Moderator not found"{
       "message": "not found"
       }
     *
     */
    public function show($id)
    {
        $data = User::whereHas('roles', fn ($query) => $query->where('name', 'moderator'))->find($id);
        if (!$data) {
            return response("This page not found", 404);
        }
        return new ModeratorResource($data);
    }
    /**
     * Create Moderator
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 20,
        "first_name": "moderator",
        "last_name": "moderator",
        "email": "moderator12@moderator1.com3",
        "role": {
            "id": 2,
            "name": "moderator"
        },
        "password": "$2y$10$8/Fbyu2MFkOzEu6WviL5xOaBjTkvMNL5btLymYkWe2YhV9pHlAmQi",
        "phone_number": 987372763
    }
}
     *
     *
     * @response 422 scenario="Validation errors"{
    "message": "The first name field is required. (and 4 more errors)",
    "errors": {
        "first_name": [
            "The first name field is required."
            "The first name field must be at least 2 characters."
            "The first name field must not be greater than 16 characters."
        ],
        "last_name": [
            "The last name field is required."
            "The last name field must be at least 2 characters."
            "The last name field must not be greater than 16 characters."
        ],
        "email": [
            "The email field is required."
            "The email field must be a valid email address."
            "The email has already been taken."
        ],
        "password": [
            "The password field is required."
            "The password field must be at least 2 characters."
            "The password field must not be greater than 16 characters."
        ],
        "phone_number": [
            "The phone number field is required."
            "The phone number field must be 9 characters."
            "The phone number has already been taken."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function store(StoreModeratorRequest $request)
    {
        $data = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone_number,
            'role_id' => 2,
        ]);
        return new ModeratorResource($data);
    }
    /**
     * Update Moderator
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 12,
        "first_name": "moderatortest",
        "last_name": "moderatortest",
        "email": "Moderat2or@Moderator.com",
        "role": {
            "id": 2,
            "name": "moderator"
        },
        "password": "$2y$10$untXIS.aGtjCWRgay6JTZumzn.8RQgTppCnwoCpNAlH5yefofUeAu",
        "phone_number": 987372761
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The first name field is required. (and 4 more errors)",
    "errors": {
        "first_name": [
            "The first name field is required."
            "The first name field must be at least 2 characters."
            "The first name field must not be greater than 16 characters."
        ],
        "last_name": [
            "The last name field is required."
            "The last name field must be at least 2 characters."
            "The last name field must not be greater than 16 characters."
        ],
        "email": [
            "The email field is required."
            "The email field must be a valid email address."
            "The email has already been taken."
        ],
        "password": [
            "The password field is required."
            "The password field must be at least 2 characters."
            "The password field must not be greater than 16 characters."
        ],
        "phone_number": [
            "The phone number field is required."
            "The phone number field must be 9 characters."
            "The phone number has already been taken."
        ]
    }
}
     *
     * @response 404 scenario="This Moderator not found"{
       "message": "not found"
       }
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function update(UpdateModeratorRequest $request, $id)
    {
        $data = User::whereHas('roles', fn ($query) => $query->where('name', 'moderator'))->find($id);
        if (!$data) {
            return response("This page not found", 404);
        }
        $data->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone_number,
            'role_id' => 2,
        ]);
        return new ModeratorResource($data);
    }
    /**
     * Delete Moderator
     * @response 204 scenario="Success Process"
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This Moderator not found"{
       "message": "not found"
       }
     *
     */
    public function destroy($id)
    {
        $moderator = User::whereHas('roles', fn ($query) => $query->where('name', 'moderator'))->find($id);
        $moderator->delete();
        return response()->noContent();
    }
}
