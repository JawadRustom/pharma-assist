<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineRequest\StoreMedicineRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineRequest\UpdateMedicineRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Moderator\MedicineResource\MedicineResource;
use App\Models\Medicine;
use App\Models\MedicineDetail;
use Illuminate\Http\Request;

/**
 * @group Medicine
 *
 * This Api For Medicine for Moderator in AdminDashboard
 */
class MedicineController extends Controller
{
    /**
     * See all Medicine
     * @response 200 scenario="Success Process"{
    "data": [
    {
    "id": 10,
    "name": "Newell Stark Sr.",
    "category": {
    "id": 15,
    "name": "Mr. Erin Bashirian PhD"
    },
    "company": {
    "id": 15,
    "name": "Miss Rebecca Dibbert III"
    },
    "Image": null
    },
    {
    "id": 9,
    "name": "Ernestina Lehner",
    "category": {
    "id": 14,
    "name": "Immanuel McKenzie"
    },
    "company": {
    "id": 14,
    "name": "Mr. Damon Johnson"
    },
    "Image": null
    }
    ],
    "links": {
    "first": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=1",
    "last": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=5",
    "prev": null,
    "next": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=2"
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
    "url": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=4",
    "label": "4",
    "active": false
    },
    {
    "url": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=5",
    "label": "5",
    "active": false
    },
    {
    "url": "http://127.0.0.1:8000/api/v1/moderator/medicines?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    ],
    "path": "http://127.0.0.1:8000/api/v1/moderator/medicines",
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
     * See medicines belong to moderator
     * @response 200 scenario="Success Process"{
    "data": [
    {
    "id": 11,
    "name": "inside Moderator both",
    "category": {
    "id": 16,
    "name": "dsa1234sad"
    },
    "company": {
    "id": 16,
    "name": "test1212331323"
    },
    "Image": {
    "id": 4,
    "imageable_id": 11,
    "imageable_type": "App\\Models\\Medicine",
    "file_name": "http://127.0.0.1:8000/storage/Medicine/qLqZgBjlQI1hLy28wKaP0QhOlLep5zyMDY18b9Lc.jpg"
    }
    }
    ],
    "links": {
    "first": "http://127.0.0.1:8000/api/v1/moderator/medicines/medicinesOfModerator?page=1",
    "last": "http://127.0.0.1:8000/api/v1/moderator/medicines/medicinesOfModerator?page=1",
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
    "url": "http://127.0.0.1:8000/api/v1/moderator/medicines/medicinesOfModerator?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": null,
    "label": "Next &raquo;",
    "active": false
    }
    ],
    "path": "http://127.0.0.1:8000/api/v1/moderator/medicines/medicinesOfModerator",
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
    public function medicinesOfModerator(Request $request)
    {
        $user = auth()->user();
        $data = Medicine::whereHas('users', fn($query) => $query->where('user_id', $user->id))->orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return MedicineResource::collection($data);
    }
    /**
     * See One Medicine
     * @response 200 scenario="Success Process"{
    "data": {
    "id": 11,
    "name": "inside Moderator both",
    "category": {
    "id": 16,
    "name": "dsa1234sad"
    },
    "company": {
    "id": 16,
    "name": "test1212331323"
    },
    "Image": {
    "id": 4,
    "imageable_id": 11,
    "imageable_type": "App\\Models\\Medicine",
    "file_name": "http://127.0.0.1:8000/storage/Medicine/qLqZgBjlQI1hLy28wKaP0QhOlLep5zyMDY18b9Lc.jpg"
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
    "name": "inside Moderator both",
    "category": {
    "id": 16,
    "name": "dsa1234sad"
    },
    "company": {
    "id": 16,
    "name": "test1212331323"
    },
    "Image": {
    "id": 4,
    "imageable_id": 11,
    "imageable_type": "App\\Models\\Medicine",
    "file_name": "http://127.0.0.1:8000/storage/Medicine/qLqZgBjlQI1hLy28wKaP0QhOlLep5zyMDY18b9Lc.jpg"
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
     * @queryparam file_name image
     * To upload image.
     *
     */
    public function store(StoreMedicineRequest $request)
    {
        $user = auth()->user();
        $data = Medicine::create([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'category_id' => $request->category_id,
            'file_name' => $request->file_name,
            'user_id' => $user->id,
        ]);
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('public/Medicine');
            $data->photos()->create(['file_name' => $photoPath]);
        }
        foreach ($request->details as $medicineDetail) {
            MedicineDetail::create([
                'medicine_type_id' => $medicineDetail['medicine_type_id'],
                'content' => $medicineDetail['content'],
                'medicine_id' => $data->id,
                'user_id' => $data->user_id,
            ]);
        }
        return new MedicineResource($data);
    }

    /**
     * Update Medicine
     * @response 200 scenario="Success Process"{
    "data": {
    "id": 11,
    "name": "inside Moderator both",
    "category": {
    "id": 16,
    "name": "dsa1234sad"
    },
    "company": {
    "id": 16,
    "name": "test1212331323"
    },
    "Image": {
    "id": 4,
    "imageable_id": 11,
    "imageable_type": "App\\Models\\Medicine",
    "file_name": "http://127.0.0.1:8000/storage/Medicine/qLqZgBjlQI1hLy28wKaP0QhOlLep5zyMDY18b9Lc.jpg"
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
     *
     */
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $user = auth()->user();
        if ($user->id == $medicine->user_id) {
            $medicine->update([
                'name' => $request->name,
                'company_id' => $request->company_id,
                'category_id' => $request->category_id,
                'user_id' => $user->id,
            ]);
            if ($request->hasFile('file_name')) {
                $photoPath = $request->file('file_name')->store('public/Medicine');
                $medicine->photos()->updateOrCreate(
                    [],
                    ['file_name' => $photoPath]
                );
            }
            MedicineDetail::where('medicine_id', $medicine->id)->delete();
            foreach ($request->details as $medicineDetail) {
                MedicineDetail::create([
                    'medicine_type_id' => $medicineDetail['medicine_type_id'],
                    'content' => $medicineDetail['content'],
                    'medicine_id' => $medicine->id,
                    'user_id' => $medicine->user_id,
                ]);
            }
            $medicine->refresh();
            return new MedicineResource($medicine);
        }
        return response("This company not belong to you", 404);
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
        $user = auth()->user();
        if ($user->id == $medicine->user_id) {
            $medicine->delete();
            return response()->noContent();
        }
        return response("This company not belong to you", 404);
    }
}
