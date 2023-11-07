<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineResource;

use App\Http\Resources\Api\V1\AdminDashboard\Admin\CategoryResource\UserResource;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineDetailResource\MedicineDetailResource;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\PhotoResource\PhotoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => new MedicineCategoryResource($this->categories),
            'company' => new MedicineCompanyResource($this->companies),
            'Image'=>new PhotoResource($this->photos),
            'user'=>new UserResource($this->users),
            'medicine_detail'=>MedicineDetailResource::collection($this->medicineDetails),
        ];
    }
}
