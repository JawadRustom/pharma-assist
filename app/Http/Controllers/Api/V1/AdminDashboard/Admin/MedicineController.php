<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineRequest\StoreMedicineRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineRequest\UpdateMedicineRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineResource\MedicineResource;
use Illuminate\Http\Request;

/**
 * @group Admin Medicine
 *
 * This Api For Admin Medicine
 */
class MedicineController extends Controller
{
    /**
     * See all Medicine
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 1,
            "name": "Ayana Rohan",
            "category": {
                "id": 6,
                "name": "Dr. Tatum Wiegand"
            },
            "company": {
                "id": 6,
                "name": "Lillian Welch"
            }
        },
        {
            "id": 2,
            "name": "Horacio Kemmer",
            "category": {
                "id": 7,
                "name": "Leonie Harber"
            },
            "company": {
                "id": 7,
                "name": "Cielo Schiller"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/medicine?page=1",
        "last": "http://127.0.0.1:8000/api/v1/medicine?page=5",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/medicine?page=2"
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
                "url": "http://127.0.0.1:8000/api/v1/medicine?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicine?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicine?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicine?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicine?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicine?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/medicine",
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
        $data = Medicine::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineResource::collection($data);
    }

    /**
     * See One Medicine
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 2,
        "name": "Horacio Kemmer",
        "category": {
            "id": 7,
            "name": "Leonie Harber"
        },
        "company": {
            "id": 7,
            "name": "Cielo Schiller"
        }
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This Medicine not found"{
       "message": "not found"
       }
     *
     */
    public function show(Request $request, Medicine $medicine)
    {
        return new MedicineResource($medicine);
    }

    /**
     * Create Medicine
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 11,
        "name": "test",
        "category": {
            "id": 1,
            "name": "Alanna Wiza II"
        },
        "company": {
            "id": 1,
            "name": "Terence Barrows V"
        }
    }
}
     *
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 2 more errors)",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "company_id": [
            "The company id field is required."
        ],
        "category_id": [
            "The category id field is required."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function store(StoreMedicineRequest $request)
    {
        $data = Medicine::create($request->validated());
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('Medicine', 'photos');
            $data->photos()->create(['file_name' => $photoPath]);
        }
        return new MedicineResource($data);
    }

    /**
     * Update Medicine
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 1,
        "name": "test",
        "category": {
            "id": 2,
            "name": "Mrs. Ashtyn McKenzie"
        },
        "company": {
            "id": 2,
            "name": "Millie Mayert"
        }
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 2 more errors)",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "company_id": [
            "The company id field is required."
        ],
        "category_id": [
            "The category id field is required."
        ]
    }
}
     *
     * @response 404 scenario="This Medicine not found"{
       "message": "not found"
       }
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->validated());
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('Medicine', 'photos');
            $medicine->photos()->updateOrCreate(
                [],
                ['file_name' => $photoPath]
            );
        }
        $medicine->refresh();
        return new MedicineResource($medicine);
    }
    /**
     * Delete Medicine
     * @response 204 scenario="Success Process"
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This Medicine not found"{
       "message": "not found"
       }
     *
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return response()->noContent();
    }
}
