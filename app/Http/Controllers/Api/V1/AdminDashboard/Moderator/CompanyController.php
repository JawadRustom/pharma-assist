<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\CompanyRequest\StoreCompanyRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Moderator\CompanyRequest\UpdateCompanyRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Moderator\CompanyResource\CompanyResource;
use Illuminate\Http\Request;

/**
 * @group Company
 *
 * This Api For Company for Moderator in AdminDashboard
 */
class CompanyController extends Controller
{
    /**
     * See all Company
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 17,
            "name": "test1212331323dsa",
            "Image": {
                "id": 2,
                "imageable_id": 17,
                "imageable_type": "App\\Models\\Company",
                "file_name": "http://127.0.0.1:8000/storage/Company/0UymNe6UvlDG4Ck3cTrsdYTuqmlTXSZchbJNrRcj.png"
            }
        },
        {
            "id": 16,
            "name": "test1212331323",
            "Image": null
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/companies?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/companies?page=9",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/moderator/companies?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 9,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/companies",
        "per_page": 2,
        "to": 2,
        "total": 17
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
        $data = Company::orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CompanyResource::collection($data);
    }
    /**
     * See companies belong to moderator
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 19,
            "name": "test1212331323sdasadZ",
            "Image": {
                "id": 3,
                "imageable_id": 19,
                "imageable_type": "App\\Models\\Company",
                "file_name": "http://127.0.0.1:8000/storage/Company/vBhSsOido5gX28DJ9ye8l2NDar0YHL921jBFnduM.png"
            }
        },
        {
            "id": 18,
            "name": "test1212331323sda",
            "Image": null
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/moderator/companies/companiesOfModerator?page=1",
        "last": "http://127.0.0.1:8000/api/v1/moderator/companies/companiesOfModerator?page=2",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/moderator/companies/companiesOfModerator?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies/companiesOfModerator?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies/companiesOfModerator?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/moderator/companies/companiesOfModerator?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/moderator/companies/companiesOfModerator",
        "per_page": 2,
        "to": 2,
        "total": 4
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
    public function companiesOfModerator(Request $request)
    {
        $user = auth()->user();
        $data = Company::whereHas('users', fn ($query) => $query->where('user_id', $user->id))->orderBy('id', 'desc')->paginate($request->perPage ?? 15);
        return CompanyResource::collection($data);
    }
    /**
     * See One Company
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 2,
        "name": "Lucious Sauer MD",
        "Image": null
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
    public function show(Request $request, Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Create Company
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 19,
        "name": "test1212331323sdasadZ",
        "Image": {
            "id": 3,
            "imageable_id": 19,
            "imageable_type": "App\\Models\\Company",
            "file_name": "http://127.0.0.1:8000/storage/Company/vBhSsOido5gX28DJ9ye8l2NDar0YHL921jBFnduM.png"
        }
    }
}
     *
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
            "The name has already been taken."
        ]
    }
}
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function store(StoreCompanyRequest $request)
    {
        $user = auth()->user();
        $data = Company::create([
            'name' => $request->name,
            'user_id' => $user->id
        ]);
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('public/Company');
            $data->photos()->create(['file_name' => $photoPath]);
        }
        return new CompanyResource($data);
    }

    /**
     * Update Company
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 17,
        "name": "test1212331323dsa",
        "Image": {
            "id": 2,
            "imageable_id": 17,
            "imageable_type": "App\\Models\\Company",
            "file_name": "http://127.0.0.1:8000/storage/Company/0UymNe6UvlDG4Ck3cTrsdYTuqmlTXSZchbJNrRcj.png"
        }
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
            "The name has already been taken."
        ]
    }
}
     *
     * @response 404 scenario="This Company not found"{
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
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $user = auth()->user();
        if ($user->id == $company->user_id) {
            $company->update([
                'name' => $request->name,
                'user_id' => $user->id
            ]);
            if ($request->hasFile('file_name')) {
                $photoPath = $request->file('file_name')->store('public/Company');
                $company->photos()->updateOrCreate(
                    [],
                    ['file_name' => $photoPath]
                );
            }
            $company->refresh();
            return new CompanyResource($company);
        }
        return response("This company not belong to you", 404);
    }
    /**
     * Delete Company
     * @response 204 scenario="Success Process"
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
    public function destroy(Company $company)
    {
        $user = auth()->user();
        if ($user->id == $company->user_id) {
            $company->delete();
            return response()->noContent();
        }
        return response("This company not belong to you", 404);
    }
}
