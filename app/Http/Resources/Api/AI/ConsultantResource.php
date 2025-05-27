<?php

namespace App\Http\Resources\Api\AI;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        // Is there a linked User?
        $user = $this->user;

        if ($user) {
            // Build display name from user’s first + last name
            $displayName = trim(sprintf('%s %s', $user->first_name, $user->last_name));

            // Pull applied_role from profile.working_role
            $appliedRole = optional($user->profile)->working_role;

            // Gather all project_path values into attachments
            $attachments = $user->portfolios
                ->pluck('project_path')
                ->filter() // drop empty
                ->values() // reindex
                ->all();
        } else {
            // Fallback to consultant’s own data
            $displayName = $this->full_name;
            $appliedRole = null;
            $attachments = [];
        }

        return [
            'id'                   => $this->id,
            'user_id'              => $user?->id,
            'name'                 => $displayName,
            'email'                => $user?->email,
            'applied_role'         => $appliedRole,
            'attachments'          => $attachments,

            // always include these consultant-specific fields
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
        ];
    }
}
