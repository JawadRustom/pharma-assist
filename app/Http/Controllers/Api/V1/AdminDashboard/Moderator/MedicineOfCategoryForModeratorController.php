<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\DataPage\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\Request;

    /**
     * @group Admin Medicine Of Category
     *
     * This Api For Medicine Of Category
     */

class MedicineOfCategoryForModeratorController extends Controller
{

    /**
     * See all Medicine inside one Category
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 11,
            "name": "inside Moderator both",
            "Image": {
                "id": 4,
                "imageable_id": 11,
                "imageable_type": "App\\Models\\Medicine",
                "file_name": "http://127.0.0.1:8000/storage/Medicine/qLqZgBjlQI1hLy28wKaP0QhOlLep5zyMDY18b9Lc.jpg"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/medicinesOfCategoryForModeratorController/dsa1234sad?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/medicinesOfCategoryForModeratorController/dsa1234sad?page=1",
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
                "url": "http://127.0.0.1:8000/api/v1/moderator/medicinesOfCategoryForModeratorController/dsa1234sad?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/medicinesOfCategoryForModeratorController/dsa1234sad",
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
     * @queryparam perPage int
     * To return limite data in single page.
     * Defaults value for variable '15'.
     * @queryparam name string
     * To return medicine from category name.
     *
     */
    public function seeMedicineOfCategoryForModerator(Request $request, $name)
    {
        $user = auth()->user();
        $data = Medicine::orderBy('id', 'desc')
            ->whereHas('categories', fn ($query) => $query->where('name', $name))
            ->whereHas('users', fn ($query) => $query->where('user_id', $user->id))
            ->paginate($request->perPage ?? 15);
        return MedicineResource::collection($data);
    }
}
