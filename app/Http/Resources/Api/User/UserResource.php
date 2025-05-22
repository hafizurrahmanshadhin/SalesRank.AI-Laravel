<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\User\PortfolioResource;
use App\Http\Resources\Api\User\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'avatar'     => $this->avatar,

            // Eager-loaded relationship
            'profile'    => $this->whenLoaded('profile', function () {
                return new ProfileResource($this->profile);
            }),

            // Only include portfolios if role is 'sales_professional'
            'portfolios' => $this->when(
                $this->role === 'sales_professional' && $this->relationLoaded('portfolios'),
                function () {
                    return PortfolioResource::collection($this->portfolios);
                }
            ),
        ];
    }
}
