<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\CategoryResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name'=>[$this->first_name,$this->last_name],
        ];
    }
}
