<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\CompanyResource;

use App\Http\Resources\Api\V1\AdminDashboard\Admin\CategoryResource\UserResource;
use App\Http\Resources\Api\V1\AdminDashboard\Admin\PhotoResource\PhotoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name'=>$this->name,
            'Image'=>new PhotoResource($this->photos),
            'user'=>new UserResource($this->users),
        ];
    }
}
