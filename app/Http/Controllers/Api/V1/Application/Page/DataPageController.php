<?php

namespace App\Http\Controllers\Api\V1\Application\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Application\DataPage\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DataPageController extends Controller
{
    public function seeDataForMedicine(Request $request,$dataFrom,$name)
    {
        $allowedCompanyValues=['company', 'companies'];
        $allowedCategoryValues=['category', 'categories'];
        //dd($dataFrom);
        //$dataFrom='company';
        //$name='test' ;
        if (in_array(strtolower($dataFrom), $allowedCompanyValues))
        {
            $data = Medicine::orderBy('id', 'desc')->whereHas('companies', fn ($query) => $query->where('name',$name))->paginate($request->perPage ?? 15);
            return MedicineResource::collection($data);
        }
        elseif (in_array(strtolower($dataFrom), $allowedCategoryValues))
        {
            $data = Medicine::orderBy('id', 'desc')->whereHas('categories', fn ($query) => $query->where('name',$name))->paginate($request->perPage ?? 15);
            return MedicineResource::collection($data);
        }
        return response(['message' => 'Invalid data value'], 400);
    }
    // public function seeDataForMedicine(Request $request, $name, $dataFrom)
    // {
    //     // Define the allowed values for company and category
    //     $allowedValues = ['company', 'companies', 'category', 'categories'];

    //     // Validate the dataFrom parameter
    //     $validator = Validator::make(['dataFrom' => $dataFrom], [
    //         'dataFrom' => [Rule::in($allowedValues)],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => 'Invalid dataFrom value'], 400);
    //     }

    //     // Set up base query
    //     $query = Medicine::orderBy('id', 'desc');

    //     // Apply the filter based on dataFrom and name
    //     if (in_array(strtolower($dataFrom), ['company', 'companies'])) {
    //         $query->whereHas('companies', fn ($query) => $query->where('name', $name));
    //     } elseif (in_array(strtolower($dataFrom), ['category', 'categories'])) {
    //         $query->whereHas('categories', fn ($query) => $query->where('name', $name));
    //     }

    //     // Paginate the results
    //     $data = $query->paginate($request->perPage ?? 15);

    //     return MedicineResource::collection($data);
    // }
    // public function seeDataForMedicine(Request $request, $name, $dataFrom): JsonResponse
    // {
    //     $allowedValues = ['company', 'companies', 'category', 'categories'];

    //     $validator = Validator::make(
    //         ['dataFrom' => $dataFrom],
    //         ['dataFrom' => [Rule::in($allowedValues)]]
    //     );

    //     if ($validator->fails()) {
    //         return response()->json(['message' => 'Invalid data value'], 400);
    //     }

    //     $query = Medicine::orderBy('id', 'desc');

    //     if (in_array(strtolower($dataFrom), ['company', 'companies'])) {
    //         $query->whereHas('companies', fn ($query) => $query->where('name', $name));
    //     } elseif (in_array(strtolower($dataFrom), ['category', 'categories'])) {
    //         $query->whereHas('categories', fn ($query) => $query->where('name', $name));
    //     }

    //     $data = $query->paginate($request->perPage ?? 15);

    //     return MedicineResource::collection($data);
    // }
}
