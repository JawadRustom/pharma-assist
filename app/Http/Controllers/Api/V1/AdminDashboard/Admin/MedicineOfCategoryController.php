<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\DataPage\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\Request;

/**
 * @group Admin Medicine Of Category
 *
 * This Api For Medicine Of Category
 */

class MedicineOfCategoryController extends Controller
{
    /**
     * See all Medicine inside one Category
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 12,
            "name": "inside Comp12",
            "Image": {
                "id": 4,
                "imageable_id": 12,
                "imageable_type": "App\\Models\\Medicine",
                "file_name": "http://127.0.0.1:8000/storage/Medicine/HBjFZoBPZJ3ITkFBZSiKms5V23huxe8kyDjsZgKk.png"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/admin/medicinesOfCategory/Dr.%20Cyrus%20Brakus%20IV?page=1",
        "last": "http://127.0.0.1:8000/api/v1/admin/medicinesOfCategory/Dr.%20Cyrus%20Brakus%20IV?page=1",
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
                "url": "http://127.0.0.1:8000/api/v1/admin/medicinesOfCategory/Dr.%20Cyrus%20Brakus%20IV?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/admin/medicinesOfCategory/Dr.%20Cyrus%20Brakus%20IV",
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
    public function seeMedicineOfCategory(Request $request, $name)
    {
        $data = Medicine::orderBy('id', 'desc')->whereHas('categories', fn ($query) => $query->where('name', $name))->paginate($request->perPage ?? 15);
        return MedicineResource::collection($data);
    }
}
