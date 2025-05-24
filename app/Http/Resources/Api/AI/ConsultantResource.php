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
        return [
            'id'                   => $this->id,
            'user'                 => [
                'id'    => $this->user?->id,
                'name'  => $this->user?->user_name,
                'email' => $this->user?->email,
            ],
            'full_name'            => $this->full_name,
            'job_title'            => $this->job_title,
            'company'              => $this->company,
            'industry'             => $this->industry,
            'location'             => $this->location,
            'linkedin_url'         => $this->linkedin_url,
            'revenue_closed'       => $this->revenue_closed,
            'total_experience'     => $this->total_experience,
            'tenure'               => $this->tenure,
            'college_degree'       => $this->college_degree,
            'performance_keywords' => $this->performance_keywords,
            'ai_score'             => $this->ai_score,
            'ranking_level'        => $this->ranking_level,
            'created_at'           => $this->created_at,
        ];
    }
}
