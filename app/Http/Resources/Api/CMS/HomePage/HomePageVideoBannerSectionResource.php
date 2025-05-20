<?php

namespace App\Http\Resources\Api\CMS\HomePage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomePageVideoBannerSectionResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'description'     => $this->description,
            'video'           => $this->video ? url($this->video) : null,
            'video_thumbnail' => $this->video_thumbnail ? url($this->video_thumbnail) : null,
        ];
    }
}
