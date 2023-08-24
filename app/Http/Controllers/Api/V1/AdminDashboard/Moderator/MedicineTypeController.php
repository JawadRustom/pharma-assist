<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Moderator;

use App\Http\Controllers\Controller;
use App\Models\MedicineType;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineTypeRequest\StoreMedicineTypeRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineTypeRequest\UpdateMedicineTypeRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Moderator\MedicineTypeResource\MedicineTypeResource;
use Illuminate\Http\Request;

/**
 * @group MedicineType
 *
 * This Api For MedicineType for Moderator in AdminDashboard
 */
class MedicineTypeController extends Controller
{
    /**
     * See all MedicineType
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 10,
            "type": "Prof. Jasmin Schumm"
        },
        {
            "id": 9,
            "type": "Alia Bruen V"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=5",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes",
        "per_page": 2,
        "to": 2,
        "total": 10
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
     * See medicines belong to moderator
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 11,
            "type": "saddsa"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes/medicineTypesOfModerator?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes/medicineTypesOfModerator?page=1",
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
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes/medicineTypesOfModerator?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/medicineTypes/medicineTypesOfModerator",
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
     *
     * @response 404 scenario="This Company not found"{
       "message": "not found"
       }
     *
     */
    public function medicineTypesOfModerator(Request $request)
    {
        $user = auth()->user();
        $data = MedicineType::whereHas('users', fn ($query) => $query->where('user_id', $user->id))->orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineTypeResource::collection($data);
    }

    /**
     * See One MedicineType
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 11,
        "type": "saddsa"
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
        "id": 11,
        "type": "saddsa"
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
        "type": "saddsa"
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
        if ($user->id == $medicineType->user_id) {
            $medicineType->update([
                'type' => $request->type,
                'user_id' => $medicineType->user_id
            ]);
            $medicineType->refresh();
            return new MedicineTypeResource($medicineType);
        }
        return response("This company not belong to you", 404);
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
        $user = auth()->user();
        if ($user->id == $medicineType->user_id) {
            $medicineType->delete();
            return response()->noContent();
        }
        return response("This company not belong to you", 404);
    }
}
