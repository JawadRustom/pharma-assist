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
    "data": {
        "id": 12,
        "first_name": "Moderator",
        "last_name": "Moderator",
        "email": "Moderator@Moderator.com",
        "role": {
            "id": 2,
            "name": "moderator"
        },
        "password": "$2y$10$FexoH9Vs9hDWn4A/xpgtDO6RBsTzkGtkucxBJ54A9wmirLWDTgcJa",
        "phone_number": 987372763
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
        "password": "$2y$10$FexoH9Vs9hDWn4A/xpgtDO6RBsTzkGtkucxBJ54A9wmirLWDTgcJa",
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
        "email": "moderator12@moderator1.com",
        "role": {
            "id": 2,
            "name": "moderator"
        },
        "password": "$2y$10$5jU0OIffSqEWOWh79NF9z.elMc/6yGraAuwVXbMOBJNDv26yTCgU6",
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
        ],
        "last_name": [
            "The last name field is required."
        ],
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ],
        "phone_number": [
            "The phone number field is required."
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
        "id": 18,
        "first_name": "moderatortest",
        "last_name": "moderatortest",
        "email": "Moderat2or@Moderator.com",
        "role": {
            "id": 2,
            "name": "moderator"
        },
        "password": "$2y$10$jIYo5cMTKNvbvQ5ClrLcZeeIBK/AVBbTZZ4saTbSXwjv4SLDR7vKi",
        "phone_number": 987372763
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The first name field is required. (and 4 more errors)",
    "errors": {
        "first_name": [
            "The first name field is required."
        ],
        "last_name": [
            "The last name field is required."
        ],
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ],
        "phone_number": [
            "The phone number field is required."
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
