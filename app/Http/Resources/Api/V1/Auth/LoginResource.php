<?php

namespace App\Http\Resources\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        $data     = parent::toArray($request);
        $userData = $data['user'] ?? [];
        $profile  = $userData['profile'] ?? [];

        return [
            'token'  => $data['token'] ?? null,
            'verify' => !empty($userData['email_verified_at']),
            'user'   => [
                'id'                      => $userData['id'] ?? null,
                'first_name'              => $userData['first_name'] ?? null,
                'last_name'               => $userData['last_name'] ?? null,
                'username'                => $userData['handle'] ?? null,
                'email'                   => $userData['email'] ?? null,
                'role'                    => $userData['role']['name'] ?? null,

                // Profile fields
                'phone_number'            => $profile['phone_number'] ?? null,
                'linkedin_profile_url'    => $profile['linkedin_profile_url'] ?? null,
                'revenue_generated_year'  => $profile['revenue_generated_year'] ?? null,
                'revenue_generated'       => $profile['revenue_generated'] ?? null,
                'industry_experience'     => $profile['industry_experience'] ?? null,
                'present_club_experience' => $profile['present_club_experience'] ?? null,
                'lead_close_ratio'        => $profile['lead_close_ratio'] ?? null,
            ],
        ];
    }
}
