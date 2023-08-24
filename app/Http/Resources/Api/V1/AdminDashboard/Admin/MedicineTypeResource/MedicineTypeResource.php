<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineTypeResource;

use App\Http\Resources\Api\V1\AdminDashboard\Admin\CategoryResource\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineTypeResource extends JsonResource
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
            'type' => $this->type,
            'user'=>new UserResource($this->users),
        ];
    }
}
