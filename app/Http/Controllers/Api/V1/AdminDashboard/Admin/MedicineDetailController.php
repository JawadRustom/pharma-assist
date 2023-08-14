<?php

    namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\MedicineDetail;
    use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineDetailRequest\StoreMedicineDetailRequest;
    use App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineDetailRequest\UpdateMedicineDetailRequest;
    use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineDetailResource\MedicineDetailResource;
    use Illuminate\Http\Request;
    /**
     * @group MedicineDetail
     *
     * This Api For MedicineDetail
     */
    class MedicineDetailController extends Controller
    {
      /**
       * See all MedicineDetail
       * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 1,
            "medicine_type": {
                "id": 6,
                "type": "Dee Anderson"
            },
            "content": "Consectetur nostrum nam voluptatem autem illo sit et. Voluptatem libero quisquam hic quae voluptas aperiam. Laborum minus cum sapiente molestias quia.",
            "medicine": {
                "id": 6,
                "name": "Dr. Daisha Deckow",
                "category": {
                    "id": 11,
                    "name": "Dr. Berta Lind DVM"
                },
                "company": {
                    "id": 11,
                    "name": "Moriah Beer"
                }
            }
        },
        {
            "id": 2,
            "medicine_type": {
                "id": 7,
                "type": "Prof. Elizabeth Gislason"
            },
            "content": "Repellat enim est voluptate cupiditate. Commodi consequuntur id maiores et voluptates eligendi quia. Nobis et recusandae enim.",
            "medicine": {
                "id": 7,
                "name": "Dr. Eldora Johnston Sr.",
                "category": {
                    "id": 12,
                    "name": "Jarvis Rempel"
                },
                "company": {
                    "id": 12,
                    "name": "Dr. Rogelio Grimes"
                }
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/medicineDetails?page=1",
        "last": "http://127.0.0.1:8000/api/v1/medicineDetails?page=3",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/medicineDetails?page=2"
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
                "url": "http://127.0.0.1:8000/api/v1/medicineDetails?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicineDetails?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicineDetails?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/medicineDetails?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/medicineDetails",
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
          $data = MedicineDetail::paginate($request->perPage ?? 15);

          return MedicineDetailResource::collection($data);
      }

      /**
       * See One MedicineDetail
       * @response 200 scenario="Success Process"{
    "data": {
        "id": 2,
        "medicine_type": {
            "id": 7,
            "type": "Prof. Elizabeth Gislason"
        },
        "content": "Repellat enim est voluptate cupiditate. Commodi consequuntur id maiores et voluptates eligendi quia. Nobis et recusandae enim.",
        "medicine": {
            "id": 7,
            "name": "Dr. Eldora Johnston Sr.",
            "category": {
                "id": 12,
                "name": "Jarvis Rempel"
            },
            "company": {
                "id": 12,
                "name": "Dr. Rogelio Grimes"
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
            "type": "test"
        },
        "content": "test test",
        "medicine": {
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
}
       *
       *
       * @response 422 scenario="Validation errors"{
    "message": "The medicine type id field is required. (and 2 more errors)",
    "errors": {
        "medicine_type_id": [
            "The medicine type id field is required."
        ],
        "content": [
            "The content field is required."
        ],
        "medicine_id": [
            "The medicine id field is required."
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
          $data = MedicineDetail::create($request->validated());
          return new MedicineDetailResource($data);
      }

      /**
       * Update MedicineDetail
       * @response 200 scenario="Success Process"{
    "data": {
        "id": 1,
        "medicine_type": {
            "id": 4,
            "type": "Baby Cormier"
        },
        "content": "sssssssssssss",
        "medicine": {
            "id": 4,
            "name": "Tony Lynch",
            "category": {
                "id": 9,
                "name": "Dr. Marilou Crooks"
            },
            "company": {
                "id": 9,
                "name": "Nash Hettinger Sr."
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
        ],
        "content": [
            "The content field is required."
        ],
        "medicine_id": [
            "The medicine id field is required."
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
          $medicineDetail->update($request->validated());
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
