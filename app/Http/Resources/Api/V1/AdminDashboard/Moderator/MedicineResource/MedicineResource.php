<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Moderator\MedicineResource;

use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineResource\MedicineCategoryResource;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineResource\MedicineCompanyResource;
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
        ];
    }
}
