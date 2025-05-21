<?php

namespace App\Http\Resources\Api\CMS\AICoachPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'              => $this->id,
            'course_title'    => $this->title,
            'instructor'      => $this->conduct_by,
            'course_duration' => $this->course_duration,
            'course_level'    => $this->course_level,
            'image'           => $this->image ? url($this->image) : null,
            'description'     => $this->description,
        ];
    }
}
