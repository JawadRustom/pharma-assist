<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Moderator\MedicineDetailResource;

use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineDetailResource\MedicineResource;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineDetailResource\MedicineTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'medicine_type'=>new MedicineTypeResource($this->medicineTypes),
            'content'=>$this->content,
            'medicine'=>new MedicineResource($this->medicines),
        ];
    }
}
