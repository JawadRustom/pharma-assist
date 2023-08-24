<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineDetailResource;

use App\Http\Resources\Api\V1\AdminDashboard\Admin\CategoryResource\UserResource;
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
            'user'=>new UserResource($this->users),
        ];
    }
}
