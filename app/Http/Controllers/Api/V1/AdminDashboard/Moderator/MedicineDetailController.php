<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Moderator;

use App\Http\Controllers\Controller;
use App\Models\MedicineDetail;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineDetailRequest\StoreMedicineDetailRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineDetailRequest\UpdateMedicineDetailRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Moderator\MedicineDetailResource\MedicineDetailResource;
use Illuminate\Http\Request;

/**
 * @group MedicineDetail
 *
 * This Api For MedicineDetail for Moderator in AdminDashboard
 */
class MedicineDetailController extends Controller
{
    /**
     * See all MedicineDetail
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 5,
            "medicine_type": {
                "id": 10,
                "type": "Prof. Jasmin Schumm"
            },
            "content": "Qui voluptatem omnis voluptatum velit nesciunt. Ut eum et numquam cum. Eius ab laboriosam veritatis sed. Ut deleniti non cumque eveniet quibusdam vero eius.",
            "medicine": {
                "id": 10,
                "name": "Newell Stark Sr.",
                "category": {
                    "id": 15,
                    "name": "Mr. Erin Bashirian PhD"
                },
                "company": {
                    "id": 15,
                    "name": "Miss Rebecca Dibbert III"
                }
            }
        },
        {
            "id": 4,
            "medicine_type": {
                "id": 9,
                "type": "Alia Bruen V"
            },
            "content": "Dolores corporis possimus repellendus mollitia consequatur eos. A voluptas excepturi dolores dolores adipisci cum error consequatur. Eveniet consequatur laudantium et quos.",
            "medicine": {
                "id": 9,
                "name": "Ernestina Lehner",
                "category": {
                    "id": 14,
                    "name": "Immanuel McKenzie"
                },
                "company": {
                    "id": 14,
                    "name": "Mr. Damon Johnson"
                }
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails?page=3",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails?page=2"
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
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails",
        "per_page": 2,
        "to": 2,
        "total": 5
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
     * See medicine details belong to moderator
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 6,
            "medicine_type": {
                "id": 3,
                "type": "Dr. Lisa Wisoky"
            },
            "content": "dsa",
            "medicine": {
                "id": 1,
                "name": "Victor Lebsack",
                "category": {
                    "id": 6,
                    "name": "Mrs. Alexandrine Kirlin II"
                },
                "company": {
                    "id": 6,
                    "name": "Delphine Cormier IV"
                }
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails/medicineDetailsOfModerator?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails/medicineDetailsOfModerator?page=1",
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
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails/medicineDetailsOfModerator?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/medicineDetails/medicineDetailsOfModerator",
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
    public function medicineDetailsOfModerator(Request $request)
    {
        $user = auth()->user();
        $data = MedicineDetail::whereHas('users', fn ($query) => $query->where('user_id', $user->id))->orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineDetailResource::collection($data);
    }

    /**
     * See One MedicineDetail
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 2,
        "medicine_type": {
            "id": 7,
            "type": "Prof. Nathaniel Kunde"
        },
        "content": "Sunt dignissimos recusandae fugiat aut explicabo voluptatibus perferendis. Dolor dolorum animi quidem. Optio iste quo dolore aspernatur.",
        "medicine": {
            "id": 7,
            "name": "Prof. Peyton Hermann",
            "category": {
                "id": 12,
                "name": "Shaun Stiedemann"
            },
            "company": {
                "id": 12,
                "name": "Ephraim Hayes"
            }
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
            "type": "Corbin Cassin"
        },
        "content": "31ew",
        "medicine": {
            "id": 2,
            "name": "Eric Heller IV",
            "category": {
                "id": 7,
                "name": "Zella Armstrong"
            },
            "company": {
                "id": 7,
                "name": "Ava Gislason"
            }
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
            "id": 3,
            "type": "Dr. Lisa Wisoky"
        },
        "content": "dsa",
        "medicine": {
            "id": 1,
            "name": "Victor Lebsack",
            "category": {
                "id": 6,
                "name": "Mrs. Alexandrine Kirlin II"
            },
            "company": {
                "id": 6,
                "name": "Delphine Cormier IV"
            }
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
        $user = auth()->user();
        if ($user->id == $medicineDetail->user_id) {
            $medicineDetail->update([
                'medicine_type_id' => $request->medicine_type_id,
                'content' => $request->content,
                'medicine_id' => $request->medicine_id,
                'user_id' => $medicineDetail->user_id
            ]);
            $medicineDetail->refresh();
            return new MedicineDetailResource($medicineDetail);
        }
        return response("This company not belong to you", 404);
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
        $user = auth()->user();
        if ($user->id == $medicineDetail->user_id) {
            $medicineDetail->delete();
            return response()->noContent();
        }
        return response("This company not belong to you", 404);
    }
}
