<?php

namespace App\Http\Resources\Api\V1\Application\HomePage;

use App\Http\Resources\Api\V1\AdminDashboard\Admin\PhotoResource\PhotoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
        ];
    }
}
