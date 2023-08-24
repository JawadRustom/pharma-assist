<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineDetail;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineDetailRequest\StoreMedicineDetailRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineDetailRequest\UpdateMedicineDetailRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineDetailResource\MedicineDetailResource;
use Illuminate\Http\Request;

/**
 * @group Admin MedicineDetail
 *
 * This Api For Admin MedicineDetail
 */
class MedicineDetailController extends Controller
{
    /**
     * See all MedicineDetail
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 6,
            "medicine_type": {
                "id": 1,
                "type": "Lew Block"
            },
            "content": "test test",
            "medicine": {
                "id": 1,
                "name": "test",
                "category": {
                    "id": 2,
                    "name": "Bert Zieme"
                },
                "company": {
                    "id": 2,
                    "name": "testtest"
                }
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
            "id": 5,
            "medicine_type": {
                "id": 10,
                "type": "Anabel Dare"
            },
            "content": "Quas blanditiis reprehenderit aliquid est. Amet est eos perspiciatis voluptatem distinctio quae provident. Adipisci aperiam accusantium et et sit rerum ipsum.",
            "medicine": {
                "id": 10,
                "name": "Retha Lind",
                "category": {
                    "id": 15,
                    "name": "Dixie Boyle"
                },
                "company": {
                    "id": 15,
                    "name": "Prof. Kameron Schumm Sr."
                }
            },
            "user": null
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/admin/medicineDetails?page=1",
        "last": "http://127.0.0.1:8000/api/v1/admin/medicineDetails?page=3",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/admin/medicineDetails?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 3,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineDetails?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineDetails?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineDetails?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/admin/medicineDetails?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/admin/medicineDetails",
        "per_page": 2,
        "to": 2,
        "total": 6
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
        $data = MedicineDetail::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineDetailResource::collection($data);
    }

    /**
     * See One MedicineDetail
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 6,
        "medicine_type": {
            "id": 1,
            "type": "Lew Block"
        },
        "content": "test test",
        "medicine": {
            "id": 1,
            "name": "test",
            "category": {
                "id": 2,
                "name": "Bert Zieme"
            },
            "company": {
                "id": 2,
                "name": "testtest"
            }
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
     * @response 404 scenario="This MedicineDetail not found"{
       "message": "not found"
       }
     *
     */
    public function show(Request $request, MedicineDetail $medicineDetail)
    {
        return new MedicineDetailResource($medicineDetail);
    }

    /**
     * Create MedicineDetail
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 6,
        "medicine_type": {
            "id": 1,
            "type": "Lew Block"
        },
        "content": "test test",
        "medicine": {
            "id": 1,
            "name": "test",
            "category": {
                "id": 2,
                "name": "Bert Zieme"
            },
            "company": {
                "id": 2,
                "name": "testtest"
            }
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
     *
     * @response 422 scenario="Validation errors"{
    "message": "The medicine type id field is required. (and 2 more errors)",
    "errors": {
        "medicine_type_id": [
            "The medicine type id field is required."
            "The selected medicine type id is invalid."
        ],
        "content": [
            "The content field is required."
        ],
        "medicine_id": [
            "The medicine id field is required."
            "The selected medicine id is invalid."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function store(StoreMedicineDetailRequest $request)
    {
        $user = auth()->user();
        $data = MedicineDetail::create([
            'medicine_type_id' => $request->medicine_type_id,
            'content' => $request->content,
            'medicine_id' => $request->medicine_id,
            'user_id' => $user->id,
        ]);
        return new MedicineDetailResource($data);
    }

    /**
     * Update MedicineDetail
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 6,
        "medicine_type": {
            "id": 1,
            "type": "Lew Block"
        },
        "content": "test test",
        "medicine": {
            "id": 1,
            "name": "test",
            "category": {
                "id": 2,
                "name": "Bert Zieme"
            },
            "company": {
                "id": 2,
                "name": "testtest"
            }
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
     * @response 422 scenario="Validation errors"{
    "message": "The medicine type id field is required. (and 2 more errors)",
    "errors": {
        "medicine_type_id": [
            "The medicine type id field is required."
            "The selected medicine type id is invalid."
        ],
        "content": [
            "The content field is required."
        ],
        "medicine_id": [
            "The medicine id field is required."
            "The selected medicine id is invalid."
        ]
    }
}
     *
     * @response 404 scenario="This MedicineDetail not found"{
       "message": "not found"
       }
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function update(UpdateMedicineDetailRequest $request, MedicineDetail $medicineDetail)
    {
        $medicineDetail->update([
            'medicine_type_id' => $request->medicine_type_id,
            'content' => $request->content,
            'medicine_id' => $request->medicine_id,
            'user_id' => $medicineDetail->user_id
        ]);
        $medicineDetail->refresh();
        return new MedicineDetailResource($medicineDetail);
    }
    /**
     * Delete MedicineDetail
     * @response 204 scenario="Success Process"
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     *
     * @response 404 scenario="This MedicineDetail not found"{
       "message": "not found"
       }
     *
     */
    public function destroy(MedicineDetail $medicineDetail)
    {
        $medicineDetail->delete();
        return response()->noContent();
    }
}
