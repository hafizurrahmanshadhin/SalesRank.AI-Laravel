<?php

namespace App\Http\Resources\Api\AI;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantDetailResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        $user = $this->user;

        // If user_id is not null, pull data from user
        if ($user) {
            // Build display name from user’s first + last name
            $displayName = trim(sprintf('%s %s', $user->first_name, $user->last_name));

            // Gather attachments from user portfolios
            $attachments = $user->portfolios
                ->pluck('project_path')
                ->filter()
                ->values()
                ->all();

            // Build an array of user details
            $userInfo = [
                'id'          => $user->id,
                'first_name'  => $user->first_name,
                'last_name'   => $user->last_name,
                'user_name'   => $user->user_name,
                'email'       => $user->email,
                'avatar'      => $user->avatar,
                'cover_photo' => $user->cover_photo,
                'role'        => $user->role,
                'status'      => $user->status,
                'created_at'  => $user->created_at,
                'updated_at'  => $user->updated_at,
            ];

            // Include profile details if present
            $profileInfo = [
                'phone_number'            => optional($user->profile)->phone_number,
                'linkedin_profile_url'    => optional($user->profile)->linkedin_profile_url,
                'revenue_generated_year'  => optional($user->profile)->revenue_generated_year,
                'revenue_generated'       => optional($user->profile)->revenue_generated,
                'industry_experience'     => optional($user->profile)->industry_experience,
                'present_club_experience' => optional($user->profile)->present_club_experience,
                'lead_close_ratio'        => optional($user->profile)->lead_close_ratio,
                'working_role'            => optional($user->profile)->working_role,
                'country'                 => optional($user->profile)->country,
                'bio'                     => optional($user->profile)->bio,
                'status'                  => optional($user->profile)->status,
            ];
        } else {
            // Fallback to consultant’s own data
            $displayName = $this->full_name;
            $attachments = [];
            $userInfo    = null;
            $profileInfo = null;
        }

        // Merge everything into the final response
        return [
            // Consultant table fields
            'id'                   => $this->id,
            'user_id'              => $user?->id,
            'display_name'         => $displayName,
            'email'                => $user?->email,
            'attachments'          => $attachments,
            'job_title'            => $this->job_title,
            'company'              => $this->company,
            'industry'             => $this->industry,
            'location'             => $this->location,
            'linkedin_url'         => $this->linkedin_url,
            'revenue_closed'       => $this->revenue_closed,
            'total_experience'     => $this->total_experience,
            'tenure'               => $this->tenure,
            'college_degree'       => (bool) $this->college_degree,
            'performance_keywords' => (bool) $this->performance_keywords,
            'ai_score'             => $this->ai_score,
            'ranking_level'        => $this->ranking_level,
            'created_at'           => $this->created_at,

            // Nested user and profile info
            'user'                 => $userInfo,
            'profile'              => $profileInfo,
        ];
    }
}
