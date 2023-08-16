<?php

namespace App\Http\Controllers\Api\V1\AdminDashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\CompanyRequest\StoreCompanyRequest;
use App\Http\Requests\Api\V1\AdminDashboard\Admin\CompanyRequest\UpdateCompanyRequest;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\CompanyResource\CompanyResource;
use Illuminate\Http\Request;

/**
 * @group Company
 *
 * This Api For Company
 */
class CompanyController extends Controller
{
    /**
     * See all Company
     * @response 200 scenario="Success Process"{
    "data": [
        {
            "id": 1,
            "name": "Mr. Olen Kreiger",
        },
        {
            "id": 2,
            "name": "Damien Heller",
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/company?page=1",
        "last": "http://127.0.0.1:8000/api/v1/company?page=8",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/v1/company?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 8,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/company?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/company",
        "per_page": 2,
        "to": 2,
        "total": 15
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
     * See One Company
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 2,
        "name": "Lyla Johnson MD"
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
        "id": 16,
        "name": "test"
    }
}
     *
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
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
        $data = Company::create($request->validated());
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('Company', 'photos');
            $data->photos()->create(['file_name' => $photoPath]);
        }
        return new CompanyResource($data);
    }

    /**
     * Update Company
     * @response 200 scenario="Success Process"{
    "data": {
        "id": 12,
        "name": "testtest"
    }
}
     *
     * @response 422 scenario="Validation errors"{
    "message": "The name field is required. (and 1 more error)",
    "errors": {
        "name": [
            "The name field is required."
        ]
    }
}
     * @response 404 scenario="This Company not found"{
       "message": "not found"
       }
     *
     * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
     *
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        if ($request->hasFile('file_name')) {
            $photoPath = $request->file('file_name')->store('Category', 'photos');
            $company->photos()->updateOrCreate(
                [],
                ['file_name' => $photoPath]
            );
        }
        $company->refresh();
        return new CompanyResource($company);
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
        $company->delete();
        return response()->noContent();
    }
}
