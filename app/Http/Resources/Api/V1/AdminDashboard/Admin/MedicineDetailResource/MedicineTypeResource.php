<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\MedicineDetailResource;

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
        ];
    }
}
