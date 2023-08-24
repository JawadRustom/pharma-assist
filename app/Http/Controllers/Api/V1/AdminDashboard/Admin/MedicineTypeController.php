<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineType;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineTypeRequest\StoreMedicineTypeRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineTypeRequest\UpdateMedicineTypeRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineTypeResource\MedicineTypeResource;
use Illuminate\Http\Request;

/**
 * @group Admin MedicineType
 *
 * This Api For Admin MedicineType
 */
class MedicineTypeController extends Controller
{
    /**
     * See all MedicineType
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 12,
            "type": "test",
            "user": {
                "id": 11,
                "full_name": [
                    "Admin",
                    "Admin"
                ]
            }
        },
        {
            "id": 11,
            "type": "test21111wqe",
            "user": {
                "id": 12,
                "full_name": [
                    "Moderator",
                    "Moderator"
                ]
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=1",
        "last": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=6",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 6,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineTypes?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/admin/medicineTypes",
        "per_page": 2,
        "to": 2,
        "total": 12
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
        $data = MedicineType::orderBy('id', 'desc')->paginate($request->perPage ?? 15);

        return MedicineTypeResource::collection($data);
    }

    /**
     * See One MedicineType
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 12,
        "type": "test",
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
     * @response 404 scenario="This MedicineType not found"{
       "message": "not found"
       }
     *
     */
    public function show(Request $request, MedicineType $medicineType)
    {
        return new MedicineTypeResource($medicineType);
    }

    /**
     * Create MedicineType
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 12,
        "type": "test",
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
     *
     * @response 422 scenario="Validation errors"{
    "message": "The type field is required.",
    "errors": {
        "type": [
            "The type field is required."
            "The type has already been taken."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function store(StoreMedicineTypeRequest $request)
    {
        $user = auth()->user();
        $data = MedicineType::create([
            'type' => $request->type,
            'user_id' => $user->id,
        ]);
        return new MedicineTypeResource($data);
    }

    /**
     * Update MedicineType
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 11,
        "type": "test21111wqe",
        "user": {
            "id": 12,
            "full_name": [
                "Moderator",
                "Moderator"
            ]
        }
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The type field is required.",
    "errors": {
        "type": [
            "The type field is required."
            "The type has already been taken."
        ]
    }
}
     *
     * @response 404 scenario="This MedicineType not found"{
       "message": "not found"
       }
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function update(UpdateMedicineTypeRequest $request, MedicineType $medicineType)
    {
        $user = auth()->user();
        $medicineType->update($request->validated());
        $medicineType->refresh();
        return new MedicineTypeResource($medicineType);
    }
    /**
     * Delete MedicineType
     * @response 204 scenario="Success Process"
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This MedicineType not found"{
       "message": "not found"
}
     *
     */
    public function destroy(MedicineType $medicineType)
    {
        $medicineType->delete();
        return response()->noContent();
    }
}
