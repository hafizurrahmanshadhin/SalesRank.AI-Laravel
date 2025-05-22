<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            'working_role' => $this->working_role,
            'country'      => $this->country,
            'bio'          => $this->bio,
        ];
    }
}
