<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\PhotoResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imageUrl = url(asset('photos/') . '/' . $this->file_name); // Using the photos disk
        return [
            'id' => $this->id,
            'imageable_id' => $this->imageable_id,
            'imageable_type' => $this->imageable_type,
            'file_name' => $imageUrl,
        ];
    }
}
