<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialiteResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'                      => $this->id,
            'avatar'                  => $this->avatar,
            'first_name'              => $this->first_name,
            'last_name'               => $this->last_name,
            'user_name'               => $this->user_name,
            'email'                   => $this->email,
            'role'                    => $this->role,
            'phone_number'            => $this->profile->phone_number ?? null,
            'linkedin_profile_url'    => $this->profile->linkedin_profile_url ?? null,
            'revenue_generated_year'  => $this->profile->revenue_generated_year ?? null,
            'revenue_generated'       => $this->profile->revenue_generated ?? null,
            'industry_experience'     => $this->profile->industry_experience ?? null,
            'present_club_experience' => $this->profile->present_club_experience ?? null,
            'lead_close_ratio'        => $this->profile->lead_close_ratio ?? null,
            'working_role'            => $this->profile->working_role ?? null,
            'country'                 => $this->profile->country ?? null,
            'bio'                     => $this->profile->bio ?? null,
        ];
    }
}
