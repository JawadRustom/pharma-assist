<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\Admin\ModeratorResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModeratorResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => new RoleResource($this->roles),
            'password' => $this->password,
            'phone_number' => $this->phone_number,
        ];
    }
}
// first_name
// last_name
// email
// role_id
// password
// phone_number
