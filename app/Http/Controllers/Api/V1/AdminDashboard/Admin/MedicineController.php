<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineRequest\StoreMedicineRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineRequest\UpdateMedicineRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineResource\MedicineResource;
use App\Models\MedicineDetail;
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
            "id": 12,
            "name": "inside Comp12",
            "category": {
                "id": 1,
                "name": "Dr. Cyrus Brakus IV"
            },
            "company": {
                "id": 1,
                "name": "Hermina Corkery"
            },
            "Image": {
                "id": 4,
                "imageable_id": 12,
                "imageable_type": "App\\Models\\Medicine",
                "file_name": "http://127.0.0.1:8000/storage/Medicine/HBjFZoBPZJ3ITkFBZSiKms5V23huxe8kyDjsZgKk.png"
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
            "id": 11,
            "name": "inside Comp",
            "category": {
                "id": 1,
                "name": "Dr. Cyrus Brakus IV"
            },
            "company": {
                "id": 1,
                "name": "Hermina Corkery"
            },
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
        "first": "http://127.0.0.1:8000/api/v1/admin/medicines?page=1",
        "last": "http://127.0.0.1:8000/api/v1/admin/medicines?page=6",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/admin/medicines?page=2"
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
                "url": "http://127.0.0.1:8000/api/v1/admin/medicines?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicines?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicines?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicines?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicines?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicines?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicines?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/admin/medicines",
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
        $data = Medicine::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineResource::collection($data);
    }

    /**
     * See One Medicine
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 12,
        "name": "inside Comp12",
        "category": {
            "id": 1,
            "name": "Dr. Cyrus Brakus IV"
        },
        "company": {
            "id": 1,
            "name": "Hermina Corkery"
        },
        "Image": {
            "id": 4,
            "imageable_id": 12,
            "imageable_type": "App\\Models\\Medicine",
            "file_name": "http://127.0.0.1:8000/storage/Medicine/HBjFZoBPZJ3ITkFBZSiKms5V23huxe8kyDjsZgKk.png"
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
            "The name has already been taken."
        ],
        "company_id": [
            "The company id field is required."
            "The selected company id is invalid."
        ],
        "category_id": [
            "The category id field is required."
            "The selected company id is invalid."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     * @bodyParam file_name image
     * To upload image.
     * @bodyParam details array required array of medicine details .Example:[{"medicine_type_id" : 1,"content" : "Your medicine details content"}]
     */
    public function store(StoreMedicineRequest $request)
    {
        $user = auth()->user();
        $data = Medicine::create([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
        ]);
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('public/Medicine');
            $data->photos()->create(['file_name' => $photoPath]);
        }
        foreach ($request->details as $medicineDetail) {
            MedicineDetail::create([
                'medicine_type_id'=>$medicineDetail->medicine_type_id,
                'content'=>$medicineDetail->content,
                'medicine_id'=>$data->id,
                'user_id'=>$data->user_id,
            ]);
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
            "name": "Bert Zieme"
        },
        "company": {
            "id": 2,
            "name": "testtest"
        },
        "Image": {
            "id": 5,
            "imageable_id": 1,
            "imageable_type": "App\\Models\\Medicine",
            "file_name": "http://127.0.0.1:8000/storage/Medicine/39TrUtdW3eKFi3adgDMRNWgvoHOwVuokr3kq13LQ.jpg"
        },
        "user": null
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 2 more errors)",
    "errors": {
        "name": [
            "The name field is required."
            "The name has already been taken."
        ],
        "company_id": [
            "The company id field is required."
            "The selected company id is invalid."
        ],
        "category_id": [
            "The company id field is required."
            "The selected company id is invalid."
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
     * @queryparam file_name image
     * To upload image.
     */
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'category_id' => $request->category_id,
            'user_id' => $medicine->user_id
        ]);
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('public/Medicine');
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
